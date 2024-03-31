<?php

namespace App\View\Components;

use Closure;
use Illuminate\View\Component;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use App\Models\AddressModel as Address;
use App\Models\Education;
use App\Models\Bank;
use App\Models\Tutor;

class accounttab extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        $tutor_id           =   Auth::id();
        $data['tutors']     =   Tutor::find($tutor_id);
        $data['address']    =   Address::where('tutor_id',$tutor_id)->first();
        $data['education']  =   Education::where('tutor_id',$tutor_id)->first();
        $data['bank']       =   Bank::where('tutor_id',$tutor_id)->first();
        return view('components.accounttab',$data);
    }
}
