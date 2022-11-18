"use strict";

function obtenerTiempoRespuestaNormal() {
    let ajax=new XMLHttpRequest();
    let metodo="GET";
    let url="https://olimpiadaset32.000webhostapp.com/hospital/index.php?consulta=obtenerTiempoRespuestaNormal";
    ajax.open(metodo,url);
    ajax.send();
    ajax.addEventListener("load",mostrarDatos);
    ajax.addEventListener("error",mostrarError);
    
    function mostrarDatos(){
        let respuesta =JSON.parse(ajax.responseText);
        document.getElementById("minN").innerHTML = respuesta[0]['tiempo'] + " MIN";
    }
    
    function mostrarError(){
        console.log('error');
    }
}

function obtenerTiempoRespuestaEmergencia() {
    let ajax=new XMLHttpRequest();
    let metodo="GET";
    let url="https://olimpiadaset32.000webhostapp.com/hospital/index.php?consulta=obtenerTiempoRespuestaEmergencia";
    ajax.open(metodo,url);
    ajax.send();
    ajax.addEventListener("load",mostrarDatos);
    ajax.addEventListener("error",mostrarError);
    
    function mostrarDatos(){
        let respuesta =JSON.parse(ajax.responseText);
        document.getElementById("minE").innerHTML = respuesta[0]['tiempo'] + " MIN";
    }
    
    function mostrarError(){
        console.log('error');
    }
}

function obtenerMedicos() {
    let ajax=new XMLHttpRequest();
    let metodo="GET";
    let url="https://olimpiadaset32.000webhostapp.com/hospital/index.php?consulta=obtenerMedicos";
    ajax.open(metodo,url);
    ajax.send();
    ajax.addEventListener("load",mostrarDatos);
    ajax.addEventListener("error",mostrarError);
    
    function mostrarDatos(){
        let respuesta =JSON.parse(ajax.responseText);
        for (const i of respuesta) {
            const tabla = document.getElementById("tablaMedicos");
            const tr = document.createElement("tr");
            tabla.appendChild(tr);

            const id = document.createElement("th");
            id.setAttribute("scope","col");
            const idT = document.createTextNode(i["id"]);
            id.appendChild(idT);
            tabla.appendChild(id);
            
            const matricula = document.createElement("td");
            matricula.setAttribute("scope","col");
            const matriculaT = document.createTextNode(i["matricula"]);
            matricula.appendChild(matriculaT);
            tabla.appendChild(matricula);

            const nombre = document.createElement("td");
            nombre.setAttribute("scope","col");
            const nombreT = document.createTextNode(i["nombre"]);
            nombre.appendChild(nombreT);
            tabla.appendChild(nombre);

            const apellido = document.createElement("td");
            apellido.setAttribute("scope","col");
            const apellidoT = document.createTextNode(i["apellido"]);
            apellido.appendChild(apellidoT);
            tabla.appendChild(apellido);

            const nickname = document.createElement("td");
            nickname.setAttribute("scope","col");
            const nicknameT = document.createTextNode(i["nickname"]);
            nickname.appendChild(nicknameT);
            tabla.appendChild(nickname);

            const mail = document.createElement("td");
            mail.setAttribute("scope","col");
            const mailT = document.createTextNode(i["mail"]);
            mail.appendChild(mailT);
            tabla.appendChild(mail);

            const cant_llamadas = document.createElement("td");
            cant_llamadas.setAttribute("scope","col");
            const cant_llamadasT = document.createTextNode(i["cant_llamadas"]);
            cant_llamadas.appendChild(cant_llamadasT);
            tabla.appendChild(cant_llamadas);

            const foto = document.createElement("td");
            foto.setAttribute("scope","col");
            const fotoT = document.createTextNode(i["foto"]);
            foto.appendChild(fotoT);
            tabla.appendChild(foto);

            const img = document.createElement("td");
            img.setAttribute("scope","col");
            tabla.appendChild(img);
        }
    }
    
    function mostrarError(){
        console.log('error');
    }
}