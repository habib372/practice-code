<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Response;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Patient\Store;
use App\Http\Requests\Admin\Patient\Update;
use Intervention\Image\Facades\Image;
use App\Models\Patient;
use App\Models\Stage;
use App\Models\Disease;
use App\Models\Country;
use App\Models\District;
use App\Models\Doctor;
use App\Models\ServiceProvider;
use App\Models\Service;
use App\Models\PatientVisit;
use App\Models\VisitAttachment;
use App\Models\Carer;
use App\Models\MedicalBoard;
use App\Models\PatientVisitCarer;
use App\Models\PatientVisitAttribute;
use App\Models\AttributeDisease;
use App\Models\Appointment;
use App\Models\DiseaseType;
use App\Models\DoctorServiceProvider;
use Illuminate\Http\Request;
use DB;
use Hash;
use File;
use Validator;
// use App\Helpers\Custom;



class PatientController extends Controller{



$patients = Patient::with(['serviceProvider', 'district', 'country'])->select('*');

return datatables()->of($patients)->addColumn('diseases', function ($row) {
    $diseaseIds = explode(',', $row->disease_id);
    $diseaseNames = Disease::whereIn('id', $diseaseIds)->pluck('name_en')->implode(', ');
    return $diseaseNames;
})->addColumn('action', function ($row) {
    // ... Your existing action column code ...
})->editColumn('district.name', function ($row) {
    return (!empty($row->district->name)) ? $row->district->name : '';
})->editColumn('service_provider.name_en', function ($row) {
    return (!empty($row->serviceProvider->name_en)) ? $row->serviceProvider->name_en : '';
})->rawColumns(['action'])->make(true);


{data: 'diseases',  name: 'diseases',searchable: search_by_all,sortable: false,
    defaultContent: 'N/A',
},

$patient = Patient::with(['disease', 'stage', 'chemotherapies' => function ($query) {
    $query->orderBy('date_of_admission', 'desc');
}])->findOrFail($id);
$diseaseIds = explode(',', $patient->disease_id);
$diseaseNames = Disease::whereIn('id', $diseaseIds)->pluck('name_en')->implode(',');}