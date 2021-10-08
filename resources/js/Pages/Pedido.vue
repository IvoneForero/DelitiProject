<template>
    <app-layout title="Pedidos">
        <template #header>
            <h2 class="text-center text-xl font-bold text-pink-800 leading-tight">
                Listado de Pedidos
            </h2>
        </template>
        <div class="overflow-x-auto">
            <div class="min-w-screen min-h-screen bg-red-50 flex justify-center bg-red-50 font-sans overflow-hidden">
                <div class="w-full lg:w-3/6">
                    <div class="bg-white shadow-md rounded my-6" v-if="modal==false">
                        <table class="min-w-max w-full table-auto">
                            <thead>
                                <tr class="bg-pink-100 text-pink-900 uppercase text-sm leading-normal">
                                    <th class="py-3 px-6 text-left">PEDIDO</th>
                                     <th class="py-3 px-6 text-left">FECHA_ENTREGA</th>
                                    <th class="py-3 px-6 text-left">ESTADO</th>
                                    <th class="py-3 px-6 text-left">ACCIÓN</th>
                                </tr>
                            </thead>
                            <tbody class="text-gray-600 text-sm font-light">
                                <tr v-for="(object, index) in arrayDatos" :key="index" class="border-b border-blue-100 hover:bg-gray-100">
                                    <td class="py-3 px-6 text-left">
                                        <div class="flex items-center">
                                            <span v-text="object.id"></span>
                                        </div>
                                    </td>
                                    <td class="py-3 px-6 text-left">
                                        <div class="flex items-center">
                                            <span v-text="object.delivery_date"></span>
                                        </div>
                                    </td>
                                    <td v-if="object.state==0" class="py-3 px-6 text-left">
                                        <span class="bg-yellow-500 text-yellow-50 py-1 px-3 rounded-full text-xs">Pendiente</span>
                                    </td>
                                    <td v-if="object.state==1" class="py-3 px-6 text-left">
                                        <span class="bg-blue-500 text-blue-50 py-1 px-7 rounded-full text-xs">Listo</span>
                                    </td>
                                    <td v-if="object.state==2" class="py-3 px-6 text-left">
                                        <span class="bg-green-500 text-green-50 py-1 px-3 rounded-full text-xs">Entregado</span>
                                    </td>
                                    <td class="py-3 px-6 text-center w-24">
                                        <div class="flex item-left justify-left">
                                            <div class="w-4 mr-2 transform hover:text-purple-500 hover:scale-110" title="Ver" @click="ver(object)">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                                </svg>
                                            </div>
                                            <div class="w-4 mr-2 transform hover:text-green-500 hover:scale-110" title="Editar">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                                                </svg>
                                            </div>
                                            <div class="w-4 mr-2 transform hover:text-red-500 hover:scale-110" title="Eliminar">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                </svg>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="bg-pink-100 overflow-hidden shadow-x2">
                            <button
                                @click="abrirModal"
                                type="button"
                                class="border border-pink-600 bg-pink-700 text-white rounded-md px-4 py-2 m-2 transition duration-500 ease select-none hover:bg-pink-500 focus:outline-none focus:shadow-outline"
                            >
                                Nuevo Pedido
                            </button>
                        </div>                        
                    </div>
                    <!-- component modal-->
                    <div class="flex justify-center items-top bg-red-50 antialiased" v-if="modal==true">
                        <div class="max-w-4xl p-6 mx-auto bg-pink-100 rounded-md shadow-md dark:bg-gray-800 mt-20">
                            <h1 class="text-xl font-bold text-pink-900 capitalize dark:text-white">{{titulo}} {{idPedido}}</h1>
                            <h3 class="text-xl font-bold text-pink-900 capitalize dark:text-white">Fecha Pedido : {{fecha}}</h3>
                            <div>
                                <div class="grid grid-cols-1 gap-6 mt-4 sm:grid-cols-4">
                                    <div>
                                        <label class="text-pink-800 dark:text-gray-200" for="passwordConfirmation">Tipo Documento</label>
                                        <select v-model="idTipoDoc" class="block w-full px-4 py-2 mt-2 text-gray-700 bg-white border border-gray-300 rounded-md dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 focus:border-pink-500 dark:focus:border-blue-500 focus:outline-none focus:ring">
                                            <option v-for="item in arrayTipoDoc" :key="item.id" :value="item.id">{{ item.doc_type }}</option>
                                        </select>
                                    </div>
                                    <div>
                                        <label class="text-pink-800 dark:text-gray-200" for="username">Número Documento</label>
                                        <input v-model="numdoc" placeholder="Ingrese No. documento" id="numdoc" type="text" class="block w-full px-4 py-2 mt-2 text-gray-700 bg-white border border-gray-300 rounded-md dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 focus:border-blue-500 dark:focus:border-blue-500 focus:outline-none focus:ring">
                                    </div>
                                    <div>
                                        <label class="text-pink-800 dark:text-gray-200" for="username">Nombres</label>
                                        <input v-model="nombres" placeholder="Ingrese sus nombres" id="username" type="text" class="block w-full px-4 py-2 mt-2 text-gray-700 bg-white border border-gray-300 rounded-md dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 focus:border-blue-500 dark:focus:border-blue-500 focus:outline-none focus:ring">
                                    </div>
                                    <div>
                                        <label class="text-pink-800 dark:text-gray-200" for="username">Apellidos</label>
                                        <input v-model="apellidos" placeholder="Ingrese sus apellidos" id="usersurname" type="text" class="block w-full px-4 py-2 mt-2 text-gray-700 bg-white border border-gray-300 rounded-md dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 focus:border-blue-500 dark:focus:border-blue-500 focus:outline-none focus:ring">
                                    </div>
                                </div>
                                <div class="grid grid-cols-1 gap-6 mt-4 sm:grid-cols-2">
                                    <div>
                                        <label class="text-pink-800 dark:text-gray-200" for="emailAddress">Dirección</label>
                                        <input v-model="direccion" placeholder="Ingrese dirección domicilio" id="Address" type="text" class="block w-full px-4 py-2 mt-2 text-gray-700 bg-white border border-gray-300 rounded-md dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 focus:border-blue-500 dark:focus:border-blue-500 focus:outline-none focus:ring">
                                    </div>
                                    <div>
                                        <label class="text-pink-800 dark:text-gray-200" for="emailAddress">Correo electronico</label>
                                        <input v-model="email" placeholder="Ingrese su email" id="emailAddress" type="email" class="block w-full px-4 py-2 mt-2 text-gray-700 bg-white border border-gray-300 rounded-md dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 focus:border-blue-500 dark:focus:border-blue-500 focus:outline-none focus:ring">
                                    </div>
                                </div>
                                <div class="grid grid-cols-1 gap-6 mt-4 sm:grid-cols-4">

                                    <div>
                                        <label class="text-pink-800 dark:text-gray-200" for="emailAddress">Teléfono</label>
                                        <input v-model="telefono" placeholder="Ingrese No. tel" id="phone" type="text" class="block w-full px-4 py-2 mt-2 text-gray-700 bg-white border border-gray-300 rounded-md dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 focus:border-blue-500 dark:focus:border-blue-500 focus:outline-none focus:ring">
                                    </div>
                                    <div>
                                        <label class="text-pink-800 dark:text-gray-200" for="Date">Fecha Entrega</label>
                                        <input v-model="fecEntrega" id="fecha" type="date" class="block w-full px-4 py-2 mt-2 text-gray-700 bg-white border border-gray-300 rounded-md dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 focus:border-blue-500 dark:focus:border-blue-500 focus:outline-none focus:ring">
                                    </div>
                                    <div>
                                        <label class="text-pink-800 dark:text-gray-200" for="emailAddress">Quien Recibe</label>
                                        <input v-model="persona" placeholder="Nombre persona recibe" id="phone" type="text" class="block w-full px-4 py-2 mt-2 text-gray-700 bg-white border border-gray-300 rounded-md dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 focus:border-blue-500 dark:focus:border-blue-500 focus:outline-none focus:ring">
                                    </div>
                                    <div>
                                        <label class="text-pink-800 dark:text-gray-200" for="passwordConfirmation">Agenda</label>
                                        <select v-model="idAgenda" class="block w-full px-4 py-2 mt-2 text-gray-700 bg-white border border-gray-300 rounded-md dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 focus:border-blue-500 dark:focus:border-blue-500 focus:outline-none focus:ring">
                                            <option v-for="item in arrayAgenda" :key="item.id" :value="item.id">{{ item.schedule }}</option>
                                        </select>
                                    </div>
                                </div>
                                <div v-if="tpAccion!=-1" class="grid grid-cols-1 gap-6 mt-4 sm:grid-cols-2">
                                    <div>
                                        <label class="text-pink-800 dark:text-gray-200" for="passwordConfirmation">Producto</label>
                                        <select v-model="idProducto" class="block w-full px-4 py-2 mt-2 text-gray-700 bg-white border border-gray-300 rounded-md dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 focus:border-blue-500 dark:focus:border-blue-500 focus:outline-none focus:ring">
                                            <option v-for="item in arrayProductos" :key="item.id" :value="item.id">{{ item.name }}</option>
                                        </select>
                                    </div>
                                    <div class="grid grid-cols-1 gap-6 mt-4 sm:grid-cols-3">
                                        <div>
                                            <label class="text-pink-800 dark:text-gray-200" for="emailAddress">Valor</label>
                                            <input v-model="Valor" id="phone" type="number" class="block w-full px-4 py-2 mt-2 text-gray-700 bg-white border border-gray-300 rounded-md dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 focus:border-blue-500 dark:focus:border-blue-500 focus:outline-none focus:ring">
                                        </div>
                                        <div>
                                            <label class="text-pink-800 dark:text-gray-200" for="emailAddress">Cantidad</label>
                                            <input v-model="cantidad" id="phone" type="number" class="block w-full px-4 py-2 mt-2 text-gray-700 bg-white border border-gray-300 rounded-md dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 focus:border-blue-500 dark:focus:border-blue-500 focus:outline-none focus:ring">
                                        </div>
                                        <div>
                                            <label class="text-pink-800 dark:text-gray-200" for="add">  </label>
                                            <button class="flex-no-shrink bg-pink-700 px-7 ml-4 py-2 text-sm shadow-sm hover:shadow-lg font-medium tracking-wider border-1 border-pink-800 text-white rounded-full">
                                                +
                                            </button>
                                        </div>
                                    </div>
                                </div>
                                <br/>
                                <div>
                                    <table class="min-w-max w-full table-auto border-separate border border-pink-800">
                                        <thead>
                                            <tr class="bg-pink-200 text-pink-900 uppercase text-sm leading-normal">
                                                <th class="py-3 px-6 text-left border border-pink-700">Producto</th>
                                                <th class="py-3 px-6 text-left border border-pink-700">Cantidad</th>
                                                <th class="py-3 px-6 text-left border border-pink-700">Valor Unitario</th>
                                                <th class="py-3 px-6 text-left border border-pink-700">Total</th>
                                                <th class="py-3 px-6 text-left border border-pink-700">Acción</th>
                                            </tr>
                                        </thead>
                                        <tbody class="text-gray-600 text-sm font-light">
                                            <tr class="border-b border-blue-100 hover:bg-gray-100">                                        
                                                <td class="py-3 px-6 text-left border border-pink-700">
                                                    <div class="flex items-center">
                                                        <span>Cupcakes</span>
                                                    </div>
                                                </td>
                                                <td class="py-3 px-6 text-left border border-pink-700">
                                                    <div class="flex items-center">
                                                        <span>5</span>
                                                    </div>
                                                </td>
                                                <td class="py-3 px-6 text-left border border-pink-700">
                                                    <div class="flex items-center">
                                                        <span>15000</span>
                                                    </div>
                                                </td>                                                
                                                <td class="py-3 px-6 text-left border border-pink-700">
                                                    <div class="flex items-center">
                                                        <span>75000</span>
                                                    </div>
                                                </td>                                                
                                                <td class="py-3 px-6 text-left border border-pink-700">
                                                    <div class="flex items-center">
                                                        <span>-</span>
                                                    </div>
                                                </td>                                                
                                            </tr>    
                                            <tr class="border-b border-blue-100 hover:bg-gray-100">                                        
                                                <td class="py-3 px-6 text-left border border-pink-700">
                                                    <div class="flex items-center">
                                                        <span>Torta</span>
                                                    </div>
                                                </td>
                                                <td class="py-3 px-6 text-left border border-pink-700">
                                                    <div class="flex items-center">
                                                        <span>1</span>
                                                    </div>
                                                </td>
                                                <td class="py-3 px-6 text-left border border-pink-700">
                                                    <div class="flex items-center">
                                                        <span>120000</span>
                                                    </div>
                                                </td>                                                
                                                <td class="py-3 px-6 text-left border border-pink-700">
                                                    <div class="flex items-center">
                                                        <span>120000</span>
                                                    </div>
                                                </td>                                                
                                                <td class="py-3 px-6 text-lef border border-pink-700">
                                                    <div class="flex items-center">
                                                        <span>-</span>
                                                    </div>
                                                </td>                                                
                                            </tr>
                                        </tbody>
                                    </table>
                                    <br/>
                                </div>   
                                <div class="grid grid-cols-1 gap-6 mt-4 sm:grid-cols-4">
                                    <div>
                                        <label class="text-pink-800 dark:text-gray-200" for="emailAddress">Total Pedido</label>
                                        <input v-model="Total" type="text" class="block w-full px-4 py-2 mt-2 text-gray-700 bg-white border border-gray-300 rounded-md dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 focus:border-blue-500 dark:focus:border-blue-500 focus:outline-none focus:ring">
                                    </div>
                                </div>     
                                <div class="flex flex-row items-center justify-between p-5 text-gray-600 border-t border-gray-200 rounded-bl-lg rounded-br-lg">
                                    <button @click="cerrarModal" class="px-6 py-2 leading-5 text-white transition-colors duration-200 transform bg-pink-700 rounded-md hover:bg-pink-600 focus:outline-none focus:bg-pink-600">
                                        Cancelar
                                    </button>
                                    <button v-if="tpAccion==0" @click="cerrarModal" class="px-6 py-2 leading-5 text-white transition-colors duration-200 transform bg-green-500 rounded-md hover:bg-green-400 focus:outline-none focus:bg-green-400">
                                        Guardar
                                    </button>
                                    <button v-if="tpAccion==1" @click="cerrarModal" class="px-6 py-2 leading-5 text-white transition-colors duration-200 transform bg-purple-700 rounded-md hover:bg-purple-600 focus:outline-none focus:bg-purple-600">
                                        Actualizar
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- component -->                    
                </div>
            </div>
        </div>
    </app-layout>
</template>

<script>
    import { defineComponent } from 'vue'
    import AppLayout from '@/Layouts/AppLayout.vue'
    import Welcome from '@/Jetstream/Welcome.vue'

    export default defineComponent(
    {
        components:
        {
            AppLayout
        },
        data() 
        {
            return{
                modal: false,
                titulo : "",
                tpAccion: 1,//1 guardar 0 actualizar
                nombre:"",
                desc:"",
                edo:"0",
                Precio:0,
                idPedido:"",
                idCliente:"",
                fecha:"",
                arrayDatos:[],
                arrayDatos:[],
                arrayTipoDoc:[],
                arrayProductos:[],
                arrayAgenda:[],
            };
        },
        methods:
        {
            listarDatos()
            {
                let me=this;
                var url="/api/order/index2";

                axios.get(url)
                .then(function(response){
                    var respuesta=response.data;
                    me.arrayDatos=respuesta.orders;
                })
                .catch(function(error){
                })
            },
            listarTipoDoc()
            {
                let me=this;
                var url="/api/tipodoc/getdata";

                axios.get(url)
                .then(function(response){
                    var respuesta=response.data;
                    me.arrayTipoDoc=respuesta.consulta;
                })
                .catch(function(error){
                })
            },
            listarAgenda()
            {
                let me=this;
                var url="/api/calendar/getdata";

                axios.get(url)
                .then(function(response){
                    var respuesta=response.data;
                    me.arrayAgenda=respuesta.calendar;
                })
                .catch(function(error){
                })
            },
            listarProductos()
            {
                let me=this;
                var url="/api/producto/getdata";

                axios.get(url)
                .then(function(response){
                    var respuesta=response.data;
                    me.arrayProductos=respuesta.consulta;
                })
                .catch(function(error){
                })
            },
            abrirModal(){
                let me=this;
                this.titulo = "Registrar Pedido"
                this.modal = true;
                me.limpiar();
                this.tpAccion=0;
                this.nombre="";
            },
            limpiar()
            {
                this.idUsuario="";
                this.idTipoDoc="";
                this.numdoc="";
                this.nombres="";                
                this.apellidos="";                
                this.telefono="";
                this.email="";
                this.direccion="";
                this.idPedido="";
            },    
            cerrarModal()
            {
                this.modal = false;
            },          
            ver(data=[])
            {
                this.idPedido=data['id'];
                this.fecha=data['order_date'];
                this.modal = true;
                this.tpAccion=-1;
                this.titulo = "Ver Pedido Nro. " 
            },

        },
        mounted()
        {
            this.listarDatos();
            this.listarTipoDoc();
            this.listarProductos();
            this.listarAgenda();
        }                
    })
</script>
