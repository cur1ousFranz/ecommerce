export function alert(string, icon = 'success'){
  Swal.fire({
    title: string,
    icon: icon,
    timer: 3000,
    toast: true,
    position: 'top-right',
    timerProgressBar: true,
    showConfirmButton: false
  });
}

export default alert
