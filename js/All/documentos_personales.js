$(document).ready(function () {
    informacion_personal(appData.numEmp)
    .then(function (info) {
        // console.log(info);
        //----------------------------------------------------------------------------
        var fecha = fecha_fancy(info.EMP_BIRTHDATE);
        var infor = `<div class="card" style="width: 20rem;">
            <div class="card-body">
                <h5 class="card-title">My información</h5>
                <br>
                <hr>
                <p class="card-text"><strong>Nombre: </strong>${info.EMP_NAME}</p>
                <p class="card-text"><strong>Email: </strong>${info.EMAIL}</p>
                <p class="card-text"><strong>Fecha de Nacimiento: </strong>${fecha}</p>
                <p class="card-text"><strong>CURP: </strong>${info.EMP_CURP}</p>
                <p class="card-text"><strong>IMSS: </strong>${info.EMP_IMSS}</p>
            </div>
        </div>`;
        $("#info").html(infor);
        //----------------------------------------------------------------------------
    })
    .catch(function (error) {
        console.error(error);
    });
    
});
