
<?php


if(!function_exists('HeaderMenu'))
{
    function HeaderMenu()
    {
        if(session('permission')){
            return session('permission');
        }
        return [];
    }
}
if(!function_exists('PermissionBtn'))
{
    function IsPermissionBtn($btn_id)
    {
        if(session('permission_btn')){
            if(in_array($btn_id,session('permission_btn'))){
                return true;
            }
        }
        return false;
    }
}
