<?php
use Illuminate\Support\Facades\Auth;
$user = Auth::user();
?>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>

$(function () {
    @if($user->profile_status == 'pending')
        Swal.fire({
            title: "Your account is pending for approval",
            showDenyButton: false,
            showCancelButton: false,
            confirmButtonText: "Ok",
        }).then((result) => {
            /* Read more about isConfirmed, isDenied below */
            if (result.isConfirmed) {
                window.location.href="logout";
            } 
        });
    @elseif($user->profile_status == 'baned')
    Swal.fire({
            title: "Your account has been baned.",
            showDenyButton: false,
            showCancelButton: false,
            confirmButtonText: "Ok",
        }).then((result) => {
            /* Read more about isConfirmed, isDenied below */
            if (result.isConfirmed) {
                window.location.href="logout";
            } 
        });
    @endif
});
</script>