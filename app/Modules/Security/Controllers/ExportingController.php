<?php

namespace App\Modules\Security\Controllers;

use App\Http\Controllers\Controller;
// use App\Modules\Security\exports\FamiliaExport;
use Maatwebsite\Excel\Facades\Excel;
use App\Modules\Security\exports\UsersExport;
use App\Modules\Security\exports\RolesExport;

/* use App\Modules\Security\exports\RdtExport;
use App\Modules\RepoRoaming\exports\LriregExport;
use App\Modules\Package\exports\PackageExport; */

class ExportingController extends Controller {

  public function roles() {
    return Excel::download(new RolesExport(), 'perfiles_export.xlsx');
  }

  public function users() {

    return Excel::download(new UsersExport(), 'users_export.xlsx');
  }

  public function roles_csv()
  {
    return Excel::download(new RolesExport(), 'perfiles_export.csv',\Maatwebsite\Excel\Excel::CSV);
  }

  public function users_csv() {
    return Excel::download(new UsersExport(), 'users_export.csv',\Maatwebsite\Excel\Excel::CSV);
  }



}
