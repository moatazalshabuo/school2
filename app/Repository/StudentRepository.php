<?php

namespace App\Repository;

use App\Models\Classroom;
use App\Models\Gender;
use App\Models\Grade;
use App\Models\Image;
use App\Models\My_Parent;
use App\Models\Nationalitie;
use App\Models\Section;
use App\Models\Student;
use App\Models\academic_year;
use App\Models\Type_Blood;
use App\Models\Religion;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class StudentRepository implements StudentRepositoryInterface
{

    public function Get_Student()
    {
        $students = Student::all();
        return view('pages.Students.index', compact('students'));
    }

    public function Edit_Student($id)
    {
        $data['Grades'] = Grade::all();
        $data['parents'] = My_Parent::all();
        $data['Genders'] = Gender::all();
        $data['nationals'] = Nationalitie::all();
        $data['bloods'] = Type_Blood::all();
        $Students =  Student::findOrFail($id);
        $acadmy_year = academic_year::where('status',1)->get();
        return view('pages.Students.edit', $data, compact('Students','acadmy_year'));
    }

    public function Update_Student($request)
    {
        try {
            $Edit_Students = Student::findorfail($request->id);
            $Edit_Students->name = ['ar' => $request->name_ar, 'en' => $request->name_en];
            $Edit_Students->email = $request->email;
            $Edit_Students->gender_id = $request->gender_id;
            $Edit_Students->nationalitie_id = $request->nationalitie_id;
            $Edit_Students->blood_id = $request->blood_id;
            $Edit_Students->Date_Birth = $request->Date_Birth;
            $Edit_Students->Grade_id = $request->Grade_id;
            $Edit_Students->Classroom_id = $request->Classroom_id;
            $Edit_Students->section_id = $request->section_id;
            $Edit_Students->parent_id = $request->parent_id;
            $Edit_Students->academic_year_id = $request->academic_year;
            $Edit_Students->save();
            toastr()->success(trans('messages.Update'));
            return redirect()->route('Students.index');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }


    public function Create_Student()
    {
        $data['my_classes'] = Grade::all();
        $data['parents'] = My_Parent::all();
        $data['Genders'] = Gender::all();
        $data['nationals'] = Nationalitie::all();
        $data['bloods'] = Type_Blood::all();
        $data['academic_years'] = academic_year::all();
        $data['Religions'] = Religion::all();
        return view('pages.Students.add', $data);
    }

    public function Show_Student($id)
    {
        $Student = Student::findorfail($id);
        return view('pages.Students.show', compact('Student'));
    }


    public function Get_classrooms($id)
    {
        $list_classes = Classroom::where("Grade_id", $id)->pluck("Name_Class", "id");
        return $list_classes;
    }

    //Get Sections
    public function Get_Sections($id)
    {
        $list_sections = Section::where("Class_id", $id)->pluck("Name_Section", "id");
        return $list_sections;
    }

    public function Store_Student($request)
    {
        DB::beginTransaction();
        try {
            // حفظ بيانات ولي الأمر
            if ($request->parent_option == 'add') {
                $parent = new My_Parent();
                $parent->email = $request->email_p;
                $parent->password = Hash::make($request->password_p);
                $parent->Name_Father = ['en' => $request->Name_Father_en, 'ar' => $request->Name_Father];
                $parent->National_ID_Father = $request->National_ID_Father;
                $parent->Passport_ID_Father = $request->Passport_ID_Father;
                $parent->Phone_Father = $request->Phone_Father;
                $parent->Job_Father = ['en' => $request->Job_Father_en, 'ar' => $request->Job_Father];
                $parent->Passport_ID_Father = $request->Passport_ID_Father;
                $parent->Nationality_Father_id = $request->Nationality_Father_id;
                $parent->Blood_Type_Father_id = $request->Blood_Type_Father_id;
                $parent->Religion_Father_id = $request->Religion_Father_id;
                $parent->Address_Father = $request->Address_Father;
                $parent->Name_Mother = ['en' => $request->Name_Mother_en, 'ar' => $request->Name_Mother];
                $parent->National_ID_Mother = $request->National_ID_Mother;
                $parent->Passport_ID_Mother = $request->Passport_ID_Mother;
                $parent->Phone_Mother = $request->Phone_Mother;
                $parent->Job_Mother = ['en' => $request->Job_Mother_en, 'ar' => $request->Job_Mother];
                $parent->Passport_ID_Mother = $request->Passport_ID_Mother;
                $parent->Nationality_Mother_id = $request->Nationality_Mother_id;
                $parent->Blood_Type_Mother_id = $request->Blood_Type_Mother_id;
                $parent->Religion_Mother_id = $request->Religion_Mother_id;
                $parent->Address_Mother = $request->Address_Mother;
                $parent->save();
            }
            // حفظ بيانات الطالب
            $students = new Student();
            $students->name = ['en' => $request->name_en, 'ar' => $request->name_ar];
            $students->email = $request->email;
            $students->password = Hash::make($request->password);
            $students->gender_id = $request->gender_id;
            $students->nationalitie_id = $request->nationalitie_id;
            $students->blood_id = $request->blood_id;
            $students->Date_Birth = $request->Date_Birth;
            $students->Grade_id = $request->Grade_id;
            $students->Classroom_id = $request->Classroom_id;
            $students->section_id = $request->section_id;
            // التحقق من أن $students ليس null قبل تعيين parent_id
            if ($students) {
                // إذا تم اختيار "Add"، استخدم القيمة المحددة من الـ Select
                if ($request->parent_option == 'add') {
                    $students->parent_id = $parent->id;
                } else { // تم اختيار "Select"، استخدم القيمة المحددة من الـ Select
                    $students->parent_id = $request->parent_id;
                }
                $students->academic_year_id = $request->academic_year_id;
                $students->save();
            } else {
                // إذا كان $students هو null، يمكنك إجراء إجراء آخر أو إلقاء خطأ أو تسجيل رسالة تحذير، حسب احتياجاتك.
                // مثلاً: 
                // throw new \Exception("Error: Could not create student record.");
                // أو 
                // Log::warning("Could not create student record.");
            }

            // insert img
            if ($request->hasfile('photos')) {
                foreach ($request->file('photos') as $file) {
                    $name = $file->getClientOriginalName();
                    $file->storeAs('attachments/students/' . $students->name, $name, 'upload_attachments');
                    // insert in image_table
                    $images = new Image();
                    $images->filename = $name;
                    $images->imageable_id = $students->id;
                    $images->imageable_type = 'App\Models\Student';
                    $images->save();
                }
            }

            DB::commit(); // insert data
            toastr()->success(trans('messages.success'));
            return redirect()->route('Students.create');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function Delete_Student($request)
    {
        Student::destroy($request->id);
        toastr()->error(trans('messages.Delete'));
        return redirect()->route('Students.index');
    }

    public function Upload_attachment($request)
    {
        foreach ($request->file('photos') as $file) {
            $name = $file->getClientOriginalName();
            $file->storeAs('attachments/students/' . $request->student_name, $file->getClientOriginalName(), 'upload_attachments');

            // insert in image_table
            $images = new image();
            $images->filename = $name;
            $images->imageable_id = $request->student_id;
            $images->imageable_type = 'App\Models\Student';
            $images->save();
        }
        toastr()->success(trans('messages.success'));
        return redirect()->route('Students.show', $request->student_id);
    }

    public function Download_attachment($studentsname, $filename)
    {
        return response()->download(public_path('attachments/students/' . $studentsname . '/' . $filename));
    }

    public function Delete_attachment($request)
    {
        // Delete img in server disk
        Storage::disk('upload_attachments')->delete('attachments/students/' . $request->student_name . '/' . $request->filename);

        // Delete in data
        image::where('id', $request->id)->where('filename', $request->filename)->delete();
        toastr()->error(trans('messages.Delete'));
        return redirect()->route('Students.show', $request->student_id);
    }
}
