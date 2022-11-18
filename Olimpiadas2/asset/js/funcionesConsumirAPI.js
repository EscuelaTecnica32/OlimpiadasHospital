"use strict";

const obtenerTiempoRespuestaNormal = () => {
    let ajax = new XMLHttpRequest();
    let metodo = "GET";
    let url = "https://olimpiadaset32.000webhostapp.com/hospital/index.php?consulta=obtenerTiempoRespuestaNormal";
    ajax.open(metodo, url);
    ajax.send();
    ajax.addEventListener("load", mostrarDatos);
    ajax.addEventListener("error", console.log);

    const mostrarDatos = () => {
        let respuesta = JSON.parse(ajax.responseText);
        document.getElementById("minN").innerHTML = respuesta[0]['tiempo'] + " MIN";
    }
}

const obtenerTiempoRespuestaEmergencia = () => {
    let ajax = new XMLHttpRequest();
    let metodo = "GET";
    let url = "https://olimpiadaset32.000webhostapp.com/hospital/index.php?consulta=obtenerTiempoRespuestaEmergencia";
    ajax.open(metodo, url);
    ajax.send();
    ajax.addEventListener("load", mostrarDatos);
    ajax.addEventListener("error", console.log);

    const mostrarDatos = () => {
        let respuesta = JSON.parse(ajax.responseText);
        document.getElementById("minE").innerHTML = respuesta[0]['tiempo'] + " MIN";
    }

}

const obtenerMedicos = () => {
    let ajax = new XMLHttpRequest();
    let metodo = "GET";
    let url = "https://olimpiadaset32.000webhostapp.com/hospital/index.php?consulta=obtenerMedicos";
    ajax.open(metodo, url);
    ajax.send();
    ajax.addEventListener("load", mostrarDatos);
    ajax.addEventListener("error", console.log);

    const mostrarDatos = () => {
        let respuesta = JSON.parse(ajax.responseText);

        document.getElementById("tablaMedicos").innerHTML = '';

        respuesta.forEach(medico => {

            document.getElementById("tablaMedicos").innerHTML += `
                <tr>
                    <td>${medico.id}</td>
                    <td>${medico.matricula}</td>
                    <td>${medico.nombre}</td>
                    <td>${medico.apellido}</td>
                    <td>${medico.nickname}</td>
                    <td>${medico.mail}</td>
                    <td>${medico.cant_llamadas}</td>
                    <td>
                        <img src="${medico.foto}" alt="${medico.nickname}.png" width="40" height="40">
                    </td>
                </tr>

            `
        });
    }
}