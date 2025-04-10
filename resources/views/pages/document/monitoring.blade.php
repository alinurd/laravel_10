@extends('components.layouts.app')

@section('title', 'Monitoring Termin')

@section('breadcrumb')
<x-dashboard.breadcrumb title="Monitoring Termin" page="{{$header['kode']}}" active="Termin {{$terminid}}" route="#" />
@endsection

@section('content')

@php
$detail=$header['getDetails'];
if(isset($header['termin'])){
$arrTermin=json_decode($header['termin']);
}
$couTermin=count($arrTermin);
$ttlNominalTermin = collect($arrTermin)->sum(fn($item) => (int) $item->nominal);


@endphp
<div class="card">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header align-items-center d-flex flex-column align-items-start">
                    <h5 class="card-title">Termin Activity {{$couTermin}} Termin</h5>
                    <div class="progress animated-progress custom-progress progress-label w-100 mt-2" style="z-index: 999;">
                        <div class="progress-bar text-white" role="progressbar"
                            style="width: 10%; background: linear-gradient(to right, red, green);"
                            aria-valuenow="30" aria-valuemin="0" aria-valuemax="100">
                            <div class="label">30%</div>
                        </div>
                    </div>


                    <div class="ms-auto mt-2">
                        <ul class="nav justify-content-end nav-tabs-custom rounded card-header-tabs border-bottom-0" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" data-bs-toggle="tab" href="#today" role="tab">Today</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-bs-toggle="tab" href="#weekly" role="tab">Weekly</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-bs-toggle="tab" href="#monthly" role="tab">Monthly</a>
                            </li>
                            @if($arrTermin)
                            @foreach($arrTermin as $termin)
                            <li class="nav-item">
                                <a class="nav-link" data-bs-toggle="tab" href="#termin{{$termin->termin}}" role="tab">Termin {{$termin->termin}}</a>
                            </li>
                            @endforeach
                            @endif
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <div class="card-body">
            <div class="tab-content text-muted">
                <div class="accordion accordion-flush" id="todayExample">
                    <div class="accordion-item border-0">
                        <div class="accordion-header" id="headingOne">
                            <a class="accordion-button p-2 shadow-none" data-bs-toggle="collapse" href="#collapseOne" aria-expanded="true">
                                <div class="d-flex">
                                    <div class="flex-shrink-0">

                                    </div>
                                    <div class="flex-grow-1 ms-3">
                                        <h6 class="fs-14 fw-bold mb-1 ">
                                            {{$header['kode']}}
                                        </h6>
                                        <small class="text-muted">dibuat Oleh: {{$header['created_by']}} pada {{$header['created_at']}}</small>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div id="collapseOne" class="accordion-collapse collapse" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                            <div class="accordion-body ms-2 ps-5">
                                Jumlah dokument: {{count($detail)}}, memiliki nilai product sebedar Rp. {{$header['nilai']}}, memiliki {{$couTermin}} termin dengan jumlah nominal keserulhan sebesar Rp. Rp {{ number_format($ttlNominalTermin, 0, ',', '.') }}
                            </div>
                        </div>
                    </div>
                </div>


                <div class="tab-pane" id="today" role="tabpanel">
                    <div class="profile-timeline">
                        <div class="accordion accordion-flush" id="todayExample">
                            <div class="accordion-item border-0">
                                <div class="accordion-header" id="headingOne">
                                    <a class="accordion-button p-2 shadow-none" data-bs-toggle="collapse" href="#collapseOne" aria-expanded="true">
                                        <div class="d-flex">
                                            <div class="flex-shrink-0">
                                                <img src="/assets/images/users/avatar-2.jpg" alt="" class="avatar-xs rounded-circle" />
                                            </div>
                                            <div class="flex-grow-1 ms-3">
                                                <h6 class="fs-14 mb-1">
                                                    Jacqueline Steve
                                                </h6>
                                                <small class="text-muted">We has changed 2 attributes on 05:16PM</small>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                                <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                                    <div class="accordion-body ms-2 ps-5">
                                        In an awareness campaign, it is vital for people to begin put 2 and 2 together and begin to recognize your cause. Too much or too little spacing, as in the example below, can make things unpleasant for the reader. The goal is to make your text as comfortable to read as possible. A wonderful serenity has taken possession of my entire soul, like these sweet mornings of spring which I enjoy with my whole heart.
                                    </div>
                                </div>
                            </div>
                            <div class="accordion-item border-0">
                                <div class="accordion-header" id="headingTwo">
                                    <a class="accordion-button p-2 shadow-none" data-bs-toggle="collapse" href="#collapseTwo" aria-expanded="false">
                                        <div class="d-flex">
                                            <div class="flex-shrink-0 avatar-xs">
                                                <div class="avatar-title bg-light text-success rounded-circle">
                                                    M
                                                </div>
                                            </div>
                                            <div class="flex-grow-1 ms-3">
                                                <h6 class="fs-14 mb-1">
                                                    Megan Elmore
                                                </h6>
                                                <small class="text-muted">Adding a new event with attachments - 04:45PM</small>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                                <div id="collapseTwo" class="accordion-collapse collapse show" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
                                    <div class="accordion-body ms-2 ps-5">
                                        <div class="row g-2">
                                            <div class="col-auto">
                                                <div class="d-flex border border-dashed p-2 rounded position-relative">
                                                    <div class="flex-shrink-0">
                                                        <i class="ri-image-2-line fs-17 text-danger"></i>
                                                    </div>
                                                    <div class="flex-grow-1 ms-2">
                                                        <h6>
                                                            <a href="javascript:void(0);" class="stretched-link">Business Template - UI/UX design</a>
                                                        </h6>
                                                        <small>685 KB</small>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-auto">
                                                <div class="d-flex border border-dashed p-2 rounded position-relative">
                                                    <div class="flex-shrink-0">
                                                        <i class="ri-file-zip-line fs-17 text-info"></i>
                                                    </div>
                                                    <div class="flex-grow-1 ms-2">
                                                        <h6>
                                                            <a href="javascript:void(0);" class="stretched-link">Bank Management System - PSD</a>
                                                        </h6>
                                                        <small>8.78 MB</small>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="accordion-item border-0">
                                <div class="accordion-header" id="headingThree">
                                    <a class="accordion-button p-2 shadow-none" data-bs-toggle="collapse" href="#collapsethree" aria-expanded="false">
                                        <div class="d-flex">
                                            <div class="flex-shrink-0">
                                                <img src="/assets/images/users/avatar-5.jpg" alt="" class="avatar-xs rounded-circle" />
                                            </div>
                                            <div class="flex-grow-1 ms-3">
                                                <h6 class="fs-14 mb-1"> New ticket received</h6>
                                                <small class="text-muted mb-2">User <span class="text-secondary">Erica245</span> submitted a ticket - 02:33PM</small>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            </div>
                            <div class="accordion-item border-0">
                                <div class="accordion-header" id="headingFour">
                                    <a class="accordion-button p-2 shadow-none" data-bs-toggle="collapse" href="#collapseFour" aria-expanded="true">
                                        <div class="d-flex">
                                            <div class="flex-shrink-0 avatar-xs">
                                                <div class="avatar-title bg-light text-muted rounded-circle">
                                                    <i class="ri-user-3-fill"></i>
                                                </div>
                                            </div>
                                            <div class="flex-grow-1 ms-3">
                                                <h6 class="fs-14 mb-1">
                                                    Nancy Martino
                                                </h6>
                                                <small class="text-muted">Commented on 12:57PM</small>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                                <div id="collapseFour" class="accordion-collapse collapse show" aria-labelledby="headingFour" data-bs-parent="#accordionExample">
                                    <div class="accordion-body ms-2 ps-5 fst-italic">
                                        " A wonderful serenity has
                                        taken possession of my
                                        entire soul, like these
                                        sweet mornings of spring
                                        which I enjoy with my whole
                                        heart. Each design is a new,
                                        unique piece of art birthed
                                        into this world, and while
                                        you have the opportunity to
                                        be creative and make your
                                        own style choices. "
                                    </div>
                                </div>
                            </div>
                            <div class="accordion-item border-0">
                                <div class="accordion-header" id="headingFive">
                                    <a class="accordion-button p-2 shadow-none" data-bs-toggle="collapse" href="#collapseFive" aria-expanded="true">
                                        <div class="d-flex">
                                            <div class="flex-shrink-0">
                                                <img src="/assets/images/users/avatar-7.jpg" alt="" class="avatar-xs rounded-circle" />
                                            </div>
                                            <div class="flex-grow-1 ms-3">
                                                <h6 class="fs-14 mb-1">
                                                    Lewis Arnold
                                                </h6>
                                                <small class="text-muted">Create new project buildng product - 10:05AM</small>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                                <div id="collapseFive" class="accordion-collapse collapse show" aria-labelledby="headingFive" data-bs-parent="#accordionExample">
                                    <div class="accordion-body ms-2 ps-5">
                                        <p class="text-muted mb-2"> Every team project can have a velzon. Use the velzon to share information with your team to understand and contribute to your project.</p>
                                        <div class="avatar-group">
                                            <a href="javascript: void(0);" class="avatar-group-item" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-placement="top" title="" data-bs-original-title="Christi">
                                                <img src="/assets/images/users/avatar-4.jpg" alt="" class="rounded-circle avatar-xs">
                                            </a>
                                            <a href="javascript: void(0);" class="avatar-group-item" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-placement="top" title="" data-bs-original-title="Frank Hook">
                                                <img src="/assets/images/users/avatar-3.jpg" alt="" class="rounded-circle avatar-xs">
                                            </a>
                                            <a href="javascript: void(0);" class="avatar-group-item" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-placement="top" title="" data-bs-original-title=" Ruby">
                                                <div class="avatar-xs">
                                                    <div class="avatar-title rounded-circle bg-light text-primary">
                                                        R
                                                    </div>
                                                </div>
                                            </a>
                                            <a href="javascript: void(0);" class="avatar-group-item" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-placement="top" title="" data-bs-original-title="more">
                                                <div class="avatar-xs">
                                                    <div class="avatar-title rounded-circle">
                                                        2+
                                                    </div>
                                                </div>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--end accordion-->
                    </div>
                </div>
                <div class="tab-pane" id="weekly" role="tabpanel">
                    <div class="profile-timeline">
                        <div class="accordion accordion-flush" id="weeklyExample">
                            <div class="accordion-item border-0">
                                <div class="accordion-header" id="heading6">
                                    <a class="accordion-button p-2 shadow-none" data-bs-toggle="collapse" href="#collapse6" aria-expanded="true">
                                        <div class="d-flex">
                                            <div class="flex-shrink-0">
                                                <img src="/assets/images/users/avatar-3.jpg" alt="" class="avatar-xs rounded-circle" />
                                            </div>
                                            <div class="flex-grow-1 ms-3">
                                                <h6 class="fs-14 mb-1">
                                                    Joseph Parker
                                                </h6>
                                                <small class="text-muted">New people joined with our company - Yesterday</small>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                                <div id="collapse6" class="accordion-collapse collapse show" aria-labelledby="heading6" data-bs-parent="#accordionExample">
                                    <div class="accordion-body ms-2 ps-5">
                                        It makes a statement, it’s
                                        impressive graphic design.
                                        Increase or decrease the
                                        letter spacing depending on
                                        the situation and try, try
                                        again until it looks right,
                                        and each letter has the
                                        perfect spot of its own.
                                    </div>
                                </div>
                            </div>
                            <div class="accordion-item border-0">
                                <div class="accordion-header" id="heading7">
                                    <a class="accordion-button p-2 shadow-none" data-bs-toggle="collapse" href="#collapse7" aria-expanded="false">
                                        <div class="d-flex">
                                            <div class="avatar-xs">
                                                <div class="avatar-title rounded-circle bg-light text-danger">
                                                    <i class="ri-shopping-bag-line"></i>
                                                </div>
                                            </div>
                                            <div class="flex-grow-1 ms-3">
                                                <h6 class="fs-14 mb-1">
                                                    Your order is placed <span class="badge bg-soft-success text-success align-middle">Completed</span>
                                                </h6>
                                                <small class="text-muted">These customers can rest assured their order has been placed - 1 week Ago</small>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            </div>
                            <div class="accordion-item border-0">
                                <div class="accordion-header" id="heading8">
                                    <a class="accordion-button p-2 shadow-none" data-bs-toggle="collapse" href="#collapse8" aria-expanded="true">
                                        <div class="d-flex">
                                            <div class="flex-shrink-0 avatar-xs">
                                                <div class="avatar-title bg-light text-success rounded-circle">
                                                    <i class="ri-home-3-line"></i>
                                                </div>
                                            </div>
                                            <div class="flex-grow-1 ms-3">
                                                <h6 class="fs-14 mb-1">
                                                    Velzon admin dashboard templates layout upload
                                                </h6>
                                                <small class="text-muted">We talked about a project on linkedin - 1 week Ago</small>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                                <div id="collapse8" class="accordion-collapse collapse show" aria-labelledby="heading8" data-bs-parent="#accordionExample">
                                    <div class="accordion-body ms-2 ps-5 fst-italic">
                                        Powerful, clean & modern
                                        responsive bootstrap 5 admin
                                        template. The maximum file
                                        size for uploads in this demo :
                                        <div class="row mt-2">
                                            <div class="col-xxl-6">
                                                <div class="row border border-dashed gx-2 p-2">
                                                    <div class="col-3">
                                                        <img src="/assets/images/small/img-3.jpg" alt="" class="img-fluid rounded" />
                                                    </div>
                                                    <!--end col-->
                                                    <div class="col-3">
                                                        <img src="/assets/images/small/img-5.jpg" alt="" class="img-fluid rounded" />
                                                    </div>
                                                    <!--end col-->
                                                    <div class="col-3">
                                                        <img src="/assets/images/small/img-7.jpg" alt="" class="img-fluid rounded" />
                                                    </div>
                                                    <!--end col-->
                                                    <div class="col-3">
                                                        <img src="/assets/images/small/img-9.jpg" alt="" class="img-fluid rounded" />
                                                    </div>
                                                    <!--end col-->
                                                </div>
                                                <!--end row-->
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="accordion-item border-0">
                                <div class="accordion-header" id="heading9">
                                    <a class="accordion-button p-2 shadow-none" data-bs-toggle="collapse" href="#collapse9" aria-expanded="false">
                                        <div class="d-flex">
                                            <div class="flex-shrink-0">
                                                <img src="/assets/images/users/avatar-6.jpg" alt="" class="avatar-xs rounded-circle" />
                                            </div>
                                            <div class="flex-grow-1 ms-3">
                                                <h6 class="fs-14 mb-1">
                                                    New ticket created <span class="badge badge-soft-info align-middle">Inprogress</span>
                                                </h6>
                                                <small class="text-muted mb-2">User <span class="text-secondary">Jack365</span> submitted a ticket - 2 week Ago</small>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            </div>
                            <div class="accordion-item border-0">
                                <div class="accordion-header" id="heading10">
                                    <a class="accordion-button p-2 shadow-none" data-bs-toggle="collapse" href="#collapse10" aria-expanded="true">
                                        <div class="d-flex">
                                            <div class="flex-shrink-0">
                                                <img src="/assets/images/users/avatar-5.jpg" alt="" class="avatar-xs rounded-circle" />
                                            </div>
                                            <div class="flex-grow-1 ms-3">
                                                <h6 class="fs-14 mb-1">
                                                    Jennifer Carter
                                                </h6>
                                                <small class="text-muted">Commented - 4 week Ago</small>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                                <div id="collapse10" class="accordion-collapse collapse show" aria-labelledby="heading10" data-bs-parent="#accordionExample">
                                    <div class="accordion-body ms-2 ps-5">
                                        <p class="text-muted fst-italic mb-2">
                                            " This is an awesome
                                            admin dashboard
                                            template. It is
                                            extremely well
                                            structured and uses
                                            state of the art
                                            components (e.g. one of
                                            the only templates using
                                            boostrap 5.1.3 so far).
                                            I integrated it into a
                                            Rails 6 project. Needs
                                            manual integration work
                                            of course but the
                                            template structure made
                                            it easy. "</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--end accordion-->
                    </div>
                </div>
                <div class="tab-pane" id="monthly" role="tabpanel">
                    <div class="profile-timeline">
                        <div class="accordion accordion-flush" id="monthlyExample">
                            <div class="accordion-item border-0">
                                <div class="accordion-header" id="heading11">
                                    <a class="accordion-button p-2 shadow-none" data-bs-toggle="collapse" href="#collapse11" aria-expanded="false">
                                        <div class="d-flex">
                                            <div class="flex-shrink-0 avatar-xs">
                                                <div class="avatar-title bg-light text-success rounded-circle">
                                                    M
                                                </div>
                                            </div>
                                            <div class="flex-grow-1 ms-3">
                                                <h6 class="fs-14 mb-1">
                                                    Megan Elmore
                                                </h6>
                                                <small class="text-muted">Adding a new event with attachments - 1 month Ago.</small>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                                <div id="collapse11" class="accordion-collapse collapse show" aria-labelledby="heading11" data-bs-parent="#accordionExample">
                                    <div class="accordion-body ms-2 ps-5">
                                        <div class="row g-2">
                                            <div class="col-auto">
                                                <div class="d-flex border border-dashed p-2 rounded position-relative">
                                                    <div class="flex-shrink-0">
                                                        <i class="ri-image-2-line fs-17 text-danger"></i>
                                                    </div>
                                                    <div class="flex-grow-1 ms-2">
                                                        <h6>
                                                            <a href="javascript:void(0);" class="stretched-link">Business Template - UI/UX design</a>
                                                        </h6>
                                                        <small>685 KB</small>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-auto">
                                                <div class="d-flex border border-dashed p-2 rounded position-relative">
                                                    <div class="flex-shrink-0">
                                                        <i class="ri-file-zip-line fs-17 text-info"></i>
                                                    </div>
                                                    <div class="flex-grow-1 ms-2">
                                                        <h6>
                                                            <a href="javascript:void(0);" class="stretched-link">Bank Management System - PSD</a>
                                                        </h6>
                                                        <small>8.78 MB</small>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-auto">
                                                <div class="d-flex border border-dashed p-2 rounded position-relative">
                                                    <div class="flex-shrink-0">
                                                        <i class="ri-file-zip-line fs-17 text-info"></i>
                                                    </div>
                                                    <div class="flex-grow-1 ms-2">
                                                        <h6>
                                                            <a href="javascript:void(0);" class="stretched-link">Bank Management System - PSD</a>
                                                        </h6>
                                                        <small>8.78 MB</small>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="accordion-item border-0">
                                <div class="accordion-header" id="heading12">
                                    <a class="accordion-button p-2 shadow-none" data-bs-toggle="collapse" href="#collapse12" aria-expanded="true">
                                        <div class="d-flex">
                                            <div class="flex-shrink-0">
                                                <img src="/assets/images/users/avatar-2.jpg" alt="" class="avatar-xs rounded-circle" />
                                            </div>
                                            <div class="flex-grow-1 ms-3">
                                                <h6 class="fs-14 mb-1">
                                                    Jacqueline Steve
                                                </h6>
                                                <small class="text-muted">We has changed 2 attributes on 3 month Ago</small>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                                <div id="collapse12" class="accordion-collapse collapse show" aria-labelledby="heading12" data-bs-parent="#accordionExample">
                                    <div class="accordion-body ms-2 ps-5">
                                        In an awareness campaign, it
                                        is vital for people to begin
                                        put 2 and 2 together and
                                        begin to recognize your
                                        cause. Too much or too
                                        little spacing, as in the
                                        example below, can make
                                        things unpleasant for the
                                        reader. The goal is to make
                                        your text as comfortable to
                                        read as possible. A
                                        wonderful serenity has taken
                                        possession of my entire
                                        soul, like these sweet
                                        mornings of spring which I
                                        enjoy with my whole heart.
                                    </div>
                                </div>
                            </div>
                            <div class="accordion-item border-0">
                                <div class="accordion-header" id="heading13">
                                    <a class="accordion-button p-2 shadow-none" data-bs-toggle="collapse" href="#collapse13" aria-expanded="false">
                                        <div class="d-flex">
                                            <div class="flex-shrink-0">
                                                <img src="/assets/images/users/avatar-5.jpg" alt="" class="avatar-xs rounded-circle" />
                                            </div>
                                            <div class="flex-grow-1 ms-3">
                                                <h6 class="fs-14 mb-1">
                                                    New ticket received
                                                </h6>
                                                <small class="text-muted mb-2">User <span class="text-secondary">Erica245</span> submitted a ticket - 5 month Ago</small>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            </div>
                            <div class="accordion-item border-0">
                                <div class="accordion-header" id="heading14">
                                    <a class="accordion-button p-2 shadow-none" data-bs-toggle="collapse" href="#collapse14" aria-expanded="true">
                                        <div class="d-flex">
                                            <div class="flex-shrink-0 avatar-xs">
                                                <div class="avatar-title bg-light text-muted rounded-circle">
                                                    <i class="ri-user-3-fill"></i>
                                                </div>
                                            </div>
                                            <div class="flex-grow-1 ms-3">
                                                <h6 class="fs-14 mb-1">
                                                    Nancy Martino
                                                </h6>
                                                <small class="text-muted">Commented on 24 Nov, 2021.</small>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                                <div id="collapse14" class="accordion-collapse collapse show" aria-labelledby="heading14" data-bs-parent="#accordionExample">
                                    <div class="accordion-body ms-2 ps-5 fst-italic">
                                        " A wonderful serenity has
                                        taken possession of my
                                        entire soul, like these
                                        sweet mornings of spring
                                        which I enjoy with my whole
                                        heart. Each design is a new,
                                        unique piece of art birthed
                                        into this world, and while
                                        you have the opportunity to
                                        be creative and make your
                                        own style choices. "
                                    </div>
                                </div>
                            </div>
                            <div class="accordion-item border-0">
                                <div class="accordion-header" id="heading15">
                                    <a class="accordion-button p-2 shadow-none" data-bs-toggle="collapse" href="#collapse15" aria-expanded="true">
                                        <div class="d-flex">
                                            <div class="flex-shrink-0">
                                                <img src="/assets/images/users/avatar-7.jpg" alt="" class="avatar-xs rounded-circle" />
                                            </div>
                                            <div class="flex-grow-1 ms-3">
                                                <h6 class="fs-14 mb-1">
                                                    Lewis Arnold
                                                </h6>
                                                <small class="text-muted">Create new project buildng product - 8 month Ago</small>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                                <div id="collapse15" class="accordion-collapse collapse show" aria-labelledby="heading15" data-bs-parent="#accordionExample">
                                    <div class="accordion-body ms-2 ps-5">
                                        <p class="text-muted mb-2">
                                            Every team project can
                                            have a velzon. Use the
                                            velzon to share
                                            information with your
                                            team to understand and
                                            contribute to your
                                            project.</p>
                                        <div class="avatar-group">
                                            <a href="javascript: void(0);" class="avatar-group-item" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-placement="top" title="" data-bs-original-title="Christi">
                                                <img src="/assets/images/users/avatar-4.jpg" alt="" class="rounded-circle avatar-xs">
                                            </a>
                                            <a href="javascript: void(0);" class="avatar-group-item" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-placement="top" title="" data-bs-original-title="Frank Hook">
                                                <img src="/assets/images/users/avatar-3.jpg" alt="" class="rounded-circle avatar-xs">
                                            </a>
                                            <a href="javascript: void(0);" class="avatar-group-item" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-placement="top" title="" data-bs-original-title=" Ruby">
                                                <div class="avatar-xs">
                                                    <div class="avatar-title rounded-circle bg-light text-primary">
                                                        R
                                                    </div>
                                                </div>
                                            </a>
                                            <a href="javascript: void(0);" class="avatar-group-item" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-placement="top" title="" data-bs-original-title="more">
                                                <div class="avatar-xs">
                                                    <div class="avatar-title rounded-circle">
                                                        2+
                                                    </div>
                                                </div>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--end accordion-->
                    </div>
                </div>

                <div class="tab-pane active" id="termin1" role="tabpanel">
                    <div class="profile-timeline">
                        <div class="accordion accordion-flush" id="monthlyExample">
                            <div id="collapse11" class="accordion-collapse collapse show align-items-center" aria-labelledby="heading11" data-bs-parent="#accordionExample">
                                <div class="accordion-body px-4">

                                    {{-- Informasi Termin --}}
                                    <div class="row g-3 justify-content-center mb-4">
                                        <div class="col-auto">
                                            <div class="d-flex flex-column border border-dashed p-3 rounded text-center">
                                                <small class="text-muted">Termin</small>
                                                <h4 class="mb-0">
                                                    <a href="javascript:void(0);" class="stretched-link text-decoration-none text-dark">Termin 1</a>
                                                </h4>
                                            </div>
                                        </div>

                                        <div class="col-auto">
                                            <div class="d-flex flex-column border border-dashed p-3 rounded text-center">
                                                <small class="text-muted">Nominal</small>
                                                <h4 class="mb-0">
                                                    <a href="javascript:void(0);" class="stretched-link text-decoration-none text-dark">Rp. 1.333</a>
                                                </h4>
                                            </div>
                                        </div>

                                        <div class="col-auto">
                                            <div class="d-flex flex-column border border-dashed p-3 rounded text-center">
                                                <small class="text-muted">Status</small>
                                                <h4 class="mb-0">
                                                    <a href="javascript:void(0);" class="stretched-link text-decoration-none text-success">Terbayar</a>
                                                </h4>
                                            </div>
                                        </div>
                                    </div>

                                    {{-- Textarea & File Upload --}}
                                    <div class="row g-3 justify-content-center">
                                        <div class="col-md-6">
                                            <div class="border border-dashed p-3 rounded">
                                                <label for="catatan" class="form-label">Catatan Tambahan</label>
                                                <textarea id="catatan" class="form-control" rows="3" placeholder="Tulis catatan di sini..."></textarea>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="border border-dashed p-3 rounded">
                                                <label for="upload" class="form-label">Upload Dokumen</label>
                                                <input type="file" id="upload" class="form-control" multiple>
                                                <div id="preview" class="mt-3 d-flex gap-2 flex-wrap"></div>
                                            </div>
                                        </div>
                                        <span class="btn btn-sm btn-primary   top-0 end-0"> Update Status Termin</span>

                                    </div>

                                </div> {{-- end accordion-body --}}
                            </div>
                        </div> {{-- end accordion --}}
                    </div>
                </div>

            </div>
        </div><!-- end card body -->
    </div><!-- end card -->
</div><!-- end col -->
</div><!-- end row -->

</div> <!-- END TERMIN -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
<script>
    document.addEventListener('DOMContentLoaded', () => {
        const uploadInput = document.getElementById('upload');
        const preview = document.getElementById('preview');
        let selectedFiles = [];

        uploadInput.addEventListener('change', () => {
            selectedFiles = Array.from(uploadInput.files); // simpan ke array
            showPreview();
        });

        function showPreview() {
            preview.innerHTML = '';
            selectedFiles.forEach((file, index) => {
                const reader = new FileReader();
                reader.onload = (e) => {
                    const wrapper = document.createElement('div');
                    wrapper.className = 'position-relative border rounded p-1';
                    wrapper.style.width = '100px';

                    const removeBtn = document.createElement('button');
                    removeBtn.innerHTML = '&times;';
                    removeBtn.className = 'btn btn-sm btn-danger position-absolute top-0 end-0';
                    removeBtn.style.zIndex = '10';
                    removeBtn.type = 'button';
                    removeBtn.onclick = () => {
                        selectedFiles.splice(index, 1);
                        showPreview();
                    };

                    let content;
                    if (file.type.startsWith('image/')) {
                        content = document.createElement('img');
                        content.src = e.target.result;
                        content.className = 'img-thumbnail';
                        content.style.width = '100%';
                        content.style.height = '80px';
                        content.style.objectFit = 'cover';
                    } else {
                        content = document.createElement('div');
                        content.className = 'text-center';
                        content.innerHTML = `
                        <i class="bi bi-file-earmark-text" style="font-size: 2rem;"></i>
                        <div class="small">${file.name}</div>
                    `;
                    }

                    wrapper.appendChild(removeBtn);
                    wrapper.appendChild(content);
                    preview.appendChild(wrapper);
                };
                reader.readAsDataURL(file);
            });
        }

    });
</script>


@endsection