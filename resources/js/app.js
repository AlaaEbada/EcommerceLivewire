import './bootstrap';

import Alpine from 'alpinejs'

window.Alpine = Alpine

Alpine.start()

import Swal from 'sweetalert2'


window.addEventListener('alert', function(event) {

    let data = event.detail;

    Swal.fire({
        title: data.title,
        icon: data.type,
        showConfirmButton:false,
        timer: '1500'
        })

});


window.addEventListener('DeleteConfirm', (event) => {

    let data = event.detail;

    Swal.fire({
        icon: data.type,
        title: data.title,
        html: data.message,
        showConfirmButton: true,
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#33cc33',
        cancelButtonText: data.no,
        confirmButtonText: data.yes,
    }).then((result) => {
        if (result.isConfirmed) {
            Livewire.dispatch('commentConfirmAction', { id: data.id });
        } else {
            Livewire.dispatch('commentActionCancel', { id: data.id });
        }
    });
});


window.addEventListener('DeleteConfirm2', (event) => {

    let data = event.detail;

    Swal.fire({
        icon: data.type,
        title: data.title,
        html: data.message,
        showConfirmButton: true,
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#33cc33',
        cancelButtonText: data.no,
        confirmButtonText: data.yes,
    }).then((result) => {
        if (result.isConfirmed) {
            Livewire.dispatch('replyConfirmAction', { id: data.id });
        } else {
            Livewire.dispatch('commentActionCancel', { id: data.id });
        }
    });
});




// document.addEventListener('livewire:navigated', () => {
//     console.log('naviggateds')
// });