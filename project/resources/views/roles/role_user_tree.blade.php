
<!--begin::Card body-->
<div class="card-body py-4">
    <div class="row mb-6">
        <!--begin::Accordion-->
        <div class="accordion" id="kt_accordion_1">
            @foreach ($page_roles_main as $main)
            <div class="accordion-item">
                <h2 class="accordion-header" id="kt_accordion_1_header_{{$main->id}}">
                    <button class="accordion-button fs-4 fw-bold" type="button" data-bs-toggle="collapse"
                        data-bs-target="#kt_accordion_1_body_{{$main->id}}" aria-expanded="true"
                        aria-controls="kt_accordion_1_body_{{$main->id}}">
                        <div class="form-check form-check-custom mt-2">
                            <input class="form-check-input" type="checkbox" value="" id="checkbox_{{$main->id}}"
                                data-bs-toggle="collapse" @checked(in_array($main->id,$page_roles_selected))
                            onclick="addRoleToUser({{$main->id}})"/>
                            <label class="form-check-label" for="1checkbox_{{$main->id}}">
                                {{$main->name}}
                            </label>
                        </div>
                    </button>
                </h2>
                <div id="kt_accordion_1_body_{{$main->id}}" class="accordion-collapse collapse show"
                    aria-labelledby="kt_accordion_1_header_{{$main->id}}" data-bs-parent="#kt_accordion_1">
                    <div class="accordion-body mr-3">
                        @foreach ($page_roles_parent as $parent)
                        @if($main->id == $parent->follow_to_id)
                        <div class="row">
                            <div class=" col-lg-3 mt-4">
                                <div class="form-check form-check-custom mt-2">
                                    <input class="form-check-input" type="checkbox"
                                        @checked(in_array($parent->id,$page_roles_selected))
                                    id="checkbox_{{$parent->id}}" onclick="addRoleToUser({{$parent->id}})"/>
                                    <label class="form-check-label" for="checkbox_{{$parent->id}}">
                                        {{$parent->name}}
                                    </label>
                                </div>
                            </div>
                            @php
                             $check_found = false;
                            @endphp
                            @foreach ($roles_btn as $btn)
                                @if($parent->id == $btn->follow_to_page)
                                    @if ($check_found == false)
                                        <div class="row mt-2 ms-20">
                                        @php $check_found = true; @endphp
                                    @endif
                                    <div class=" col-lg-3 mt-2">
                                        <div class="form-check form-check-custom mt-2">
                                            <input class="form-check-input form-check-input-btn" type="checkbox"
                                                style="background-color: #8e8eaf !important;"
                                                @checked(in_array($btn->id,$roles_btns_selected))
                                            id="checkbox_btn_{{$btn->id}}" onclick="addRoleBtnToUser({{$btn->id}})"/>
                                            <label class="form-check-label" for="checkbox_btn_{{$btn->id}}">
                                                {{$btn->name}}
                                            </label>
                                        </div>
                                    </div>
                                @endif

                            @endforeach
                            @if ($check_found == true)
                            </div>
                            @endif
                        </div>
                        @endif
                        @endforeach
                    </div>
                </div>
            </div>
            <!--end::Accordion-->
            @endforeach
        </div>
    </div>
</div>
<!--end::Card body-->
<script>
    function addRoleToUser(role_id)
    {
        var user_id = $('#P_USER_NO').val();
        var url = "{{ route('roles.changeRolePageToUser') }}";
        $.ajax({
            url: url,
            method: 'post',
            data: {
                user_id: user_id,
                role_id:role_id
            },
        }).done(function(response) {
            if(response.success == 1){
                toastr["success"](response.results);
            }else{
                toastr["error"](response.errors);
            }
        });
    }
    function addRoleBtnToUser(roleBtn_id)
    {
        var user_id = $('#P_USER_NO').val();
        var url = "{{ route('roles_btn.changeRoleBtnToUser') }}";
        $.ajax({
            url: url,
            method: 'post',
            data: {
                user_id: user_id,
                role_btn_id:roleBtn_id
            },
        }).done(function(response) {
            if(response.success == 1){
                toastr["success"](response.results);
            }else{
                toastr["error"](response.errors);
            }
        });
    }
</script>
