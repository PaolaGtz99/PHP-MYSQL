
class baseDatos{

    xhttp;
    url;
    params;

    constructor(){
        this.xhttp = new XMLHttpRequest();
    }

    AJAX(){
        this.xhttp.open("POST", this.url , true);
        this.xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        this.xhttp.send(this.params);
    }

    cancelarPedido(id){
        this.url = '../controlador/eliminar.php';
        this.params = "id="+id;
        this.AJAX();
    }
    
    añadirPedido(cli,tip,fecha){
        this.url = '../controlador/add.php';
        this.params = "cliente="+cli + "&tipo="+ tip + "&fecha="+ fecha;
        this.AJAX();
    }

    pedidoEntregado(id){
        this.url = '../controlador/entregado.php';
        this.params = "id="+id;
        this.AJAX();
    }

    editarInv(id,prod,cant,prov){
        this.url = '../controlador/editarInv.php';
        this.params = "id="+id + "&prod="+ prod + "&cant="+ cant+ "&prov="+ prov;
        this.AJAX();
    }

    setCliente(nombre,tel,dir){
        this.url = '../controlador/aCliente.php';
        this.params = "nombre="+ nombre + "&telefono="+ tel+ "&dircl="+ dir;
        this.AJAX();
    }

}

class Pedido{
    cliente;
    tipoPed;
    fecha;

    constructor(){

        this.cliente = document.getElementById('nomCli').value;
        this.tipoPed = document.getElementById('tipoPed').value;
        this.fecha = document.getElementById('entrega').value;
        
    }

    valido(){

        if(this.cliente != "" && this.tipoPed != "" && this.fecha != "" ){
            document.getElementById('error').style.display = 'none';
            this.llamarBD();
            this.pedAñadido();
        } 
        else {
            document.getElementById('error').style.display = 'inline';
        } 
    }

    pedAñadido(){
        document.getElementById('nomCli').value = '';
        document.getElementById('tipoPed').value = '';
        document.getElementById('entrega').value = '';

    }
    
    llamarBD(){
        bd = new baseDatos;
        bd.añadirPedido(this.cliente,this.tipoPed,this.fecha);
    }
}

class Producto{
    id;
    nombre;
    proveedor;
    cant;

    constructor(id){
        this.id = id;
        this.obtenerDatos();
    }

    obtenerDatos(){
        
        var xhttp = new XMLHttpRequest();
        var url = '../controlador/producto.php';
        var params = 'id='+ this.id;
           
        xhttp.open("POST", url , true);
        xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xhttp.send(params);
        
        xhttp.onreadystatechange = function(){
            
            if(xhttp.readyState == 4 && xhttp.status == 200){
                var producto = JSON.parse(xhttp.responseText);
                document.getElementById('idInv').value = producto[0];
                document.getElementById('prod').value = producto[1];
                document.getElementById('cant').value = producto[2];
                document.getElementById('prov').value = producto[3];
                
            }
        } 
        this.habilitar();
        
    }

    habilitar(){
        document.getElementById('prod').disabled = false;
        document.getElementById('cant').disabled = false;
        document.getElementById('prov').disabled = false;
        document.getElementById('guardar').disabled = false;
    }

   

}

class Cliente{
    idCl;
    nombre;
    telefono;
    direccion;

    constructor(){
        this.nombre = document.getElementById('nomcl').value;
        this.telefono = document.getElementById('telcl').value;
        this.direccion = document.getElementById('dircl').value;
    }

    validar(){
        if(this.nombre != '' && this.telefono != '' && this.direccion != ''){
            document.getElementById('error').style.display = 'none';
            this.llamarBD();
            this.anadido();
        }else {
            document.getElementById('error').style.display = 'inline';
        }
    }

    anadido(){
        document.getElementById('nomcl').value = '';
        document.getElementById('telcl').value = '';
        document.getElementById('dircl').value = '';
    }

    llamarBD(){
        bd = new baseDatos;
        bd.setCliente(this.nombre,this.telefono,this.direccion);
    }

}

function elegir(op,id){
    
    //op = 1 ---> cancelar pedido
    //op = 2 ---> añadir pedido
    //op = 3 ---> pedido entregado
    //op = 4 ---> editar inventario
    //op = 5 ---> guardar inventario
    //op = 6 ---> añadir cliente


    bd = new baseDatos();
    switch(op){
        case 1: bd.cancelarPedido(id); break;

        case 2: nuevo = new Pedido(); nuevo.valido(); break;

        case 3: bd.pedidoEntregado(id); break;

        case 4: prod = new Producto(id); break;

        case 5: obtenerValores(); break;
        
        case 6: cli = new Cliente(); cli.validar(); break;
    }
    if(op<4) setTimeout(() => {  mostrar('pedidos.php'); }, 1500);
    if(op==5) setTimeout(() => {  mostrar('inventario.php'); }, 1500);

    
}
function obtenerValores(){
    var id = document.getElementById('idInv').value;
    var prod = document.getElementById('prod').value;
    var cant = document.getElementById('cant').value;
    var prov = document.getElementById('prov').value;

    bd=new baseDatos;
    bd.editarInv(id,prod,cant,prov);
}

function mostrar(op){
   
    this.xhttp = new XMLHttpRequest();
    url = '../controlador/'+op;
    xhttp.open("POST", this.url , true);
    xhttp.send();
    xhttp.onreadystatechange = function(){
        if(xhttp.readyState == 4 && xhttp.status == 200){
            document.getElementById('pantalla').innerHTML = JSON.parse(xhttp.responseText);  
        }
    }
 
}
