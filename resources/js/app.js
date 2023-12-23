import './bootstrap';
import Swal from 'sweetalert2'

window.Echo.private('App.User')
.notification((notification) => {
    console.log(notification)
    Swal.fire({
        title: "Nouvelle commande !",
        icon: 'info'
    })
});
