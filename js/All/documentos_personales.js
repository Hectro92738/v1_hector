$(document).ready(function () {
    informacion_personal(appData.numEmp)
    .then(function (info) {
        // console.log(info);
        //----------------------------------------------------------------------------
        var fecha = fecha_fancy(info.EMP_BIRTHDATE);
        var fecha_ingreso = fecha_fancy(info.EMP_ACT_CON);
        var SEXO;
        if (info.EMP_SEX =='F') {
            SEXO = 'FEMENINO';
        }else if(info.EMP_SEX=='M'){
            SEXO = 'MASCULINO';
        }

        var infor = `<div class="card text-center" >
            <div class="container text-left">
                <h5 class="card-title">Mi información</h5>
                <br>
                <hr>
                <div class="row">
                    <div class="col"><strong>Jefe inmediato: </strong> Aqui va el jefe inmediato</p></div>
                    <div class="col"><strong>Adscripción: </strong> ${info.ORGANIZACION}</div>
                </div>
                <div class="row">  
                    <div class="col"><strong>Dirección: </strong>${info.DIRE}</div>
                    <div class="col"><strong>NOM_NAME_1: </strong>${info.NOM_NAME_1}</div>
                </div>
                <br>
                <hr>
                <div class="row">   
                    <div class="col"><strong>Núm Empleado: </strong>${appData.numEmp}</div>
                    <div class="col"><strong>Nombre: </strong>${info.EMP_NAME}</div>
                </div>
                <div class="row"> 
                    <div class="col"><strong>Email: </strong>${info.EMAIL}</div>
                    <div class="col"><strong>Fecha de Nacimiento: </strong>${fecha}</div>
                </div>
                <div class="row"> 
                    <div class="col"><strong>CURP: </strong>${info.EMP_CURP}</div>
                    <div class="col"><strong>IMSS: </strong>${info.EMP_IMSS}</div>
                </div>
                <div class="row"> 
                    <div class="col"><strong>PUESTO: </strong>${info.JOBNAME}</div>
                    <div class="col"><strong>FECHA INGRESO: </strong>${fecha_ingreso}</div>
                </div>
                <div class="row"> 
                    <div class="col"><strong>RFC: </strong>${info.EMP_RFC}</div>
                    <div class="col"><strong>SINDICALIZADO: </strong>${info.SINDICALIZADO_N_S}</div>
                </div>
                <div class="row"> 
                    <div class="col"><strong>TIPO CONTRATO: </strong>${info.TIPO_CONTRATO}</div>
                    <div class="col"><strong>EDAD: </strong>${info.EMP_AGE} años</div>
                </div>
                <div class="row">  
                    <div class="col"><strong>SEXO: </strong>${SEXO}</div>
              
                <div class="col"><strong>ESTADO CIVIL: </strong>INDEFINIDO</div>    
            </div>
        </div>`;
        $("#info").html(infor);
        //----------------------------------------------------------------------------
    })
    .catch(function (error) {
        console.error(error);
    });
    
});
