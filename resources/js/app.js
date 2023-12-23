import './bootstrap';
import Swal from 'sweetalert2'



window.Echo.bind('App.User').notification((notification)=>{
    console.log(notification)
})
