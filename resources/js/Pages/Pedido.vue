<template>
    <app-layout title="Pedidos">
        <template #header>
            <h2 class="text-center text-xl font-bold text-pink-800 leading-tight">
                Listado de Pedidos
            </h2>
        </template>
        <div class="overflow-x-auto">
            <div class="min-w-screen min-h-screen bg-red-50 flex justify-center bg-red-50 font-sans overflow-hidden">
                <div class="w-full lg:w-4/6">
                    <div class="bg-white shadow-md rounded my-6" v-if="modal==false">
                        <table class="min-w-max w-full table-auto">
                            <thead>
                                <tr class="bg-pink-100 text-pink-900 uppercase text-sm leading-normal">
                                    <th class="py-3 px-6 text-left">PEDIDO</th>
                                    <th class="py-3 px-6 text-left">FECHA_ENTREGA</th>
                                    <th class="py-3 px-6 text-left">CLIENTE</th>
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
                                    <td class="py-3 px-6 text-left">
                                        <div class="flex items-center">
                                            <span>{{ object.names }} {{ object.surnames }}</span>
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
                    <!-- Modal-->
                    <div class="flex justify-center items-top bg-red-50 antialiased" v-if="modal==true">
                        <div class="w-5/6 lg:w-5/6">
                            <ul class="flex mb-0 list-none flex-wrap pt-3 pb-4 flex-row">
                                <li class="-mb-px mr-2 last:mr-0 flex-auto text-center">
                                <a class="text-xs font-bold uppercase px-5 py-3 shadow-lg rounded block leading-normal" v-on:click="toggleTabs(1)" v-bind:class="{'text-pink-600 bg-white': openTab !== 1, 'text-white bg-pink-600': openTab === 1}">
                                    <i class="fas fa-space-shuttle text-base mr-1"></i>Cliente
                                </a>
                                </li>
                                <li class="-mb-px mr-2 last:mr-0 flex-auto text-center">
                                <a class="text-xs font-bold uppercase px-5 py-3 shadow-lg rounded block leading-normal" v-on:click="toggleTabs(2)" v-bind:class="{'text-pink-600 bg-white': openTab !== 2, 'text-white bg-pink-600': openTab === 2}">
                                    <i class="fas fa-cog text-base mr-1"></i>Productos
                                </a>
                                </li>
                                <li class="-mb-px mr-2 last:mr-0 flex-auto text-center">
                                <a class="text-xs font-bold uppercase px-5 py-3 shadow-lg rounded block leading-normal" v-on:click="toggleTabs(3)" v-bind:class="{'text-pink-600 bg-white': openTab !== 3, 'text-white bg-pink-600': openTab === 3}">
                                    <i class="fas fa-briefcase text-base mr-1"></i>Entrega
                                </a>
                                </li>
                            </ul> 
                            <div class="relative flex flex-col min-w-0 break-words bg-white w-full mb-6 shadow-lg rounded">
                                <div class="px-4 py-5 flex-auto">
                                    <div class="tab-content tab-space">
                                        <div v-bind:class="{'hidden': openTab !== 1, 'block': openTab === 1}">
                                            <div class="text-center font-bold text-xl text-pink-800 leading-tight uppercase">
                                                <H1>Datos Orden de compra</H1>
                                            </div>
                                            <div class="grid grid-cols-1 gap-6 mt-4 sm:grid-cols-2">
                                                <div>
                                                    <label class="text-pink-800 dark:text-gray-200" for="passwordConfirmation">Tipo Documento</label>
                                                    <select v-model="idTipoDoc" class="block w-full px-4 py-2 mt-2 text-gray-700 bg-white border border-gray-300 rounded-md dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 focus:border-blue-500 dark:focus:border-blue-500 focus:outline-none focus:ring">
                                                        <option v-for="item in arrayTipoDoc" :key="item.id" :value="item.id">{{ item.doc_type }}</option>
                                                    </select>
                                                </div>    
                                                <div>
                                                    <label class="text-pink-800 dark:text-gray-200" for="username">Número Documento</label>
                                                    <input v-model="numdoc" @keyup.enter="datosCliente" placeholder="Ingrese No. documento" id="numdoc" type="text" class="block w-full px-4 py-2 mt-2 text-gray-700 bg-white border border-gray-300 rounded-md dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 focus:border-blue-500 dark:focus:border-blue-500 focus:outline-none focus:ring">
                                                </div>                                    
                                                <div>
                                                    <label class="text-pink-800 dark:text-gray-200" for="username">Nombres</label>
                                                    <input v-model="nombres" placeholder="Ingrese sus nombres" id="username" type="text" class="block w-full px-4 py-2 mt-2 text-gray-700 bg-white border border-gray-300 rounded-md dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 focus:border-blue-500 dark:focus:border-blue-500 focus:outline-none focus:ring">
                                                </div>
                                                <div>
                                                    <label class="text-pink-800 dark:text-gray-200" for="username">Apellidos</label>
                                                    <input v-model="apellidos" placeholder="Ingrese sus apellidos" id="usersurname" type="text" class="block w-full px-4 py-2 mt-2 text-gray-700 bg-white border border-gray-300 rounded-md dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 focus:border-blue-500 dark:focus:border-blue-500 focus:outline-none focus:ring">
                                                </div>
                                                <div>
                                                    <label class="text-pink-800 dark:text-gray-200" for="emailAddress">Correo electronico</label>
                                                    <input v-model="email" placeholder="Ingrese su email" id="emailAddress" type="email" class="block w-full px-4 py-2 mt-2 text-gray-700 bg-white border border-gray-300 rounded-md dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 focus:border-blue-500 dark:focus:border-blue-500 focus:outline-none focus:ring">
                                                </div>
                                                <div>
                                                    <label class="text-pink-800 dark:text-gray-200" for="emailAddress">Teléfono</label>
                                                    <input v-model="telefono" placeholder="Ingrese No. tel" id="phone" type="text" class="block w-full px-4 py-2 mt-2 text-gray-700 bg-white border border-gray-300 rounded-md dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 focus:border-blue-500 dark:focus:border-blue-500 focus:outline-none focus:ring">
                                                </div>
                                            </div>
                                            <div class="grid grid-cols-1 gap-6 mt-4 sm:grid-cols-1">                                            
                                                <div>
                                                    <label class="text-pink-800 dark:text-gray-200" for="emailAddress">Dirección</label>
                                                    <input v-model="direccion" placeholder="Ingrese dirección domicilio" id="Address" type="text" class="block w-full px-4 py-2 mt-2 text-gray-700 bg-white border border-gray-300 rounded-md dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 focus:border-blue-500 dark:focus:border-blue-500 focus:outline-none focus:ring">
                                                </div>
                                            </div>
                                        </div>
                                        <div v-bind:class="{'hidden': openTab !== 2, 'block': openTab === 2}">
                                            <div class="text-center font-bold text-xl text-pink-800 leading-tight uppercase">
                                                <H1>Selección de Productos</H1>
                                            </div>
                                            <div v-if="tpAccion!=-1" class="grid grid-cols-1 gap-6 mt-4 sm:grid-cols-1">
                                                <div>
                                                    <label class="text-pink-800 dark:text-gray-200" for="Product">Producto</label>
                                                    <select v-model="idProducto" @change="getValorProducto" class="block w-full px-4 py-2 mt-2 text-gray-700 bg-white border border-gray-300 rounded-md dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 focus:border-blue-500 dark:focus:border-blue-500 focus:outline-none focus:ring">
                                                        <option v-for="item in arrayProductos" :key="item.id" :value="item.id">{{ item.name }}</option>
                                                    </select>
                                                </div>
                                            </div>    
                                            <div v-if="tpAccion!=-1" class="grid grid-cols-1 gap-6 mt-4 sm:grid-cols-3">
                                                <div>
                                                    <label class="text-pink-800 dark:text-gray-200" for="Cantidad">Cantidad</label>
                                                    <input v-model="cantidad" id="cantidad" type="number" class="block w-full px-4 py-2 mt-2 text-gray-700 bg-white border border-gray-300 rounded-md dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 focus:border-blue-500 dark:focus:border-blue-500 focus:outline-none focus:ring">
                                                </div>
                                                <div>
                                                    <label class="text-pink-800 dark:text-gray-200" for="ValorUnidad">Valor</label>
                                                    <input v-model="valor" id="ValorUnidad" type="number" class="block w-full px-4 py-2 mt-2 text-gray-700 bg-white border border-gray-300 rounded-md dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 focus:border-blue-500 dark:focus:border-blue-500 focus:outline-none focus:ring">
                                                </div>
                                                <div>
                                                    <br/>
                                                    <button title="Agregar Producto" @click="agregarDetalleProd" class="flex-no-shrink bg-pink-700 px-10 ml-4 py-2 text-sm shadow-sm hover:shadow-lg font-medium tracking-wider border-1 border-pink-800 text-white rounded-full">
                                                        +
                                                    </button>
                                                </div>
                                            </div>
                                            <br/>
                                            <div>
                                                <table class="min-w-max w-full table-auto border-separate border border-pink-800">
                                                    <thead>
                                                        <tr class="bg-pink-200 text-pink-900 uppercase text-sm leading-normal">
                                                            <th class="py-3 px-6 text-center border border-pink-700">Producto</th>
                                                            <th class="py-3 px-6 text-center border border-pink-700">Cantidad</th>
                                                            <th class="py-3 px-6 text-center border border-pink-700">Valor Unitario</th>
                                                            <th class="py-3 px-6 text-center border border-pink-700">Total</th>
                                                            <th class="py-3 px-6 text-center border border-pink-700">Acción</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody v-if="arrayDetallePedido.length" class="text-gray-600 text-sm font-light">
                                                        <tr v-for="(detalle, index) in arrayDetallePedido" :key="detalle.id"  class="border-b border-blue-100 hover:bg-gray-100">                                        
                                                            <td class="py-3 px-6 text-left border border-pink-700">
                                                                <div class="flex items-center">
                                                                    <span>{{ detalle.name }}</span>
                                                                </div>
                                                            </td>
                                                            <td class="py-3 px-6 text-center border border-pink-700">
                                                                <div class="flex items-center">
                                                                    <span>{{ detalle.units }}</span>
                                                                </div>
                                                            </td>
                                                            <td class="py-3 px-6 text-right border border-pink-700">
                                                                <div class="flex items-center">
                                                                    <span>{{ detalle.unit_price }}</span>
                                                                </div>
                                                            </td>                                                
                                                            <td class="py-3 px-6 text-right border border-pink-700">
                                                                <div class="flex items-center">
                                                                    <span>{{ detalle.total }}</span>
                                                                </div>
                                                            </td>                                                
                                                            <td class="py-3 px-6 text-left border border-pink-700">
                                                                <div class="w-4 mr-2 transform hover:text-red-500 hover:scale-110" title="Eliminar">
                                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                                    </svg>
                                                                </div>
                                                            </td>                                                
                                                        </tr>
                                                        <tr class="bg-pink-200 text-pink-900 border-b border-blue-100 hover:bg-pink-200">
                                                            <td colspan="3" class="py-3 px-6 text-right border border-pink-700 font-bold" align="right">
                                                                <h3>TOTAL</h3>
                                                            </td>
                                                            <td class="py-3 px-6 text-left border border-pink-700 font-bold" align="right">
                                                                <h3>{{sumar}}</h3>
                                                            </td>   
                                                            <td class="py-3 px-6 text-left border border-pink-700">
                                                            </td>   
                                                        </tr> 
                                                    </tbody>
                                                    <tbody v-else class="text-gray-600 text-sm font-light">
                                                        <tr colspan="5" class="border-b border-blue-100 hover:bg-gray-100">No existen productos agregados al pedido</tr>
                                                    </tbody>
                                                </table>
                                                <br/>
                                            </div>
                                        </div>
                                        <div v-bind:class="{'hidden': openTab !== 3, 'block': openTab === 3}">
                                            <div class="text-center font-bold text-xl text-pink-800 leading-tight uppercase">
                                                <H1>Datos de Entrega</H1>
                                            </div>

                                            <div class="grid grid-cols-1 gap-6 mt-4 sm:grid-cols-2">    
                                                <div>
                                                    <label class="text-pink-800 dark:text-gray-200" for="Date">Fecha Entrega</label>
                                                    <input v-model="fecEntrega" id="fecha" type="date" class="block w-full px-4 py-2 mt-2 text-gray-700 bg-white border border-gray-300 rounded-md dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 focus:border-blue-500 dark:focus:border-blue-500 focus:outline-none focus:ring">
                                                </div>
                                                <div>
                                                    <label class="text-pink-800 dark:text-gray-200" for="agenda">Agenda</label>
                                                    <select v-model="idAgenda" class="block w-full px-4 py-2 mt-2 text-gray-700 bg-white border border-gray-300 rounded-md dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 focus:border-blue-500 dark:focus:border-blue-500 focus:outline-none focus:ring">
                                                        <option v-for="item in arrayAgenda" :key="item.id" :value="item.id">{{ item.schedule }}</option>
                                                    </select>
                                                </div>
                                                <div>
                                                    <label class="text-pink-800 dark:text-gray-200" for="recibe">Quien Recibe</label>
                                                    <input v-model="recibe" placeholder="Nombre persona quien recibe" id="recibe" type="text" class="block w-full px-4 py-2 mt-2 text-gray-700 bg-white border border-gray-300 rounded-md dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 focus:border-blue-500 dark:focus:border-blue-500 focus:outline-none focus:ring">
                                                </div>
                                                <div>
                                                    <label class="text-pink-800 dark:text-gray-200" for="recibe">Teléfono quien recibe</label>
                                                    <input v-model="telefonoRecibe" placeholder="Teléfono de quien recibe" id="recibe" type="text" class="block w-full px-4 py-2 mt-2 text-gray-700 bg-white border border-gray-300 rounded-md dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 focus:border-blue-500 dark:focus:border-blue-500 focus:outline-none focus:ring">
                                                </div>
                                            </div>                                                
                                            <div class="grid grid-cols-1 gap-6 mt-4 sm:grid-cols-1">
                                                <div>
                                                    <label class="text-pink-800 dark:text-gray-200" for="direccionEntrega">Dirección Entrega</label>
                                                    <input v-model="direccionEntrega" placeholder="Ingrese dirección domicilio" id="direccionEntrega" type="text" class="block w-full px-4 py-2 mt-2 text-gray-700 bg-white border border-gray-300 rounded-md dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 focus:border-blue-500 dark:focus:border-blue-500 focus:outline-none focus:ring">
                                                </div>
                                                <div>
                                                    <label class="text-pink-800 dark:text-gray-200" for="mensaje">Mensaje</label>
                                                    <textarea v-model="mensaje" placeholder="Ingrese mensaje para la tarjeta" rows="5" cols="50" class="block w-full px-4 py-2 mt-2 text-gray-700 bg-white border border-gray-300 rounded-md dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 focus:border-blue-500 dark:focus:border-blue-500 focus:outline-none focus:ring"></textarea>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="flex gap-4 justify-center border-t p-4">
                                        <button
                                            class="py-2 px-4 border rounded-md border-blue-600 text-blue-600 cursor-pointer uppercase text-sm font-bold hover:bg-blue-500 hover:text-white hover:shadow"
                                            @click="openTab--" v-if="openTab>1"
                                            >Atrás</button>
                                        <button
                                            class="py-2 px-4 border rounded-md border-blue-600 text-blue-600 cursor-pointer uppercase text-sm font-bold hover:bg-blue-500 hover:text-white hover:shadow"
                                            @click="openTab++" v-if="openTab<3"
                                            >Siguiente</button>
                                    </div>
                                </div>
                                <div>
                                    <div class="flex flex-row items-center justify-between p-5 text-gray-600 border-t border-gray-200 rounded-bl-lg rounded-br-lg">
                                        <button @click="cerrarModal" class="px-4 py-2 text-white font-semibold bg-purple-600 rounded">
                                            Cancelar
                                        </button>
                                        <button v-if="tpAccion==0 && openTab==3" @click="registrar" class="px-4 py-2 text-white font-semibold bg-green-400 rounded">
                                            Guardar
                                        </button>
                                        <button v-if="tpAccion==1" @click="update" class="px-4 py-2 text-white font-semibold bg-green-400 rounded">
                                            Actualizar
                                        </button>
                                    </div>
                                </div>    
                            </div>                           
                        </div>
                    </div>
                    <!-- Fin Modal-->
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
                openTab: 1,
                modal: false,
                titulo : "",
                tpAccion: 1,//1 guardar 0 actualizar
                nombres:"",
                apellidos:"",
                telefono:"",
                email:"",
                direccion:"",
                desc:"",
                edo:"0",
                precio:0,
                idTipoDoc:"",
                numdoc:"",
                idPedido:"",                
                idCliente:"",
                idProducto:"",
                idAgenda:"",
                valor:0,
                cantidad:0,
                fecha:"",
                arrayDatos:[],
                arrayDetalleProducto:[],
                arrayDatosUsu:[],
                arrayTipoDoc:[],
                arrayProductos:[],
                arrayAgenda:[],
                arrayDetallePedido:[],
                valorPedido:0,
                recibe:"",
                telefonoRecibe:"",
                direccionEntrega:"",
                mensaje:"",
            };
        },
        methods:
        {
            toggleTabs: function(tabNumber)
            {
                this.openTab = tabNumber
            },
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
            datosCliente()
            {
                let me=this;
                var url="/api/user/getdata?tipoBuscar="+ this.idTipoDoc + "&numBuscar=" + this.numdoc;

                axios.get(url)
                .then(function(response){
                    var respuesta=response.data;
                    me.arrayDatosUsu=respuesta.usuarios;
                    me.idCliente=respuesta.usuarios[0]['id'];
                    me.nombres = respuesta.usuarios[0]['names'];
                    me.apellidos = respuesta.usuarios[0]['surnames'];
                    me.telefono = respuesta.usuarios[0]['phone'];
                    me.direccion = respuesta.usuarios[0]['address'];
                    me.email = respuesta.usuarios[0]['email'];
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
                this.getDetallePedido();
                this.fecha=data['order_date'];
                this.idCliente=data['id_client'];
                this.idTipoDoc=data['type_doc'];
                this.numdoc=data['doc_num'];
                this.datosCliente();             
                this.fecEntrega=data['delivery_date'];
                this.idAgenda=data['id_calendar'];
                this.recibe=data['receive_name'];
                this.telefonoRecibe=data['receive_phone'];
                this.direccionEntrega=data['deliv_adrress'];

                this.mensaje=data['message'];
                this.modal = true;
                this.tpAccion=-1;
                this.titulo = "Ver Pedido Nro. " 
            },
            getValorProducto()
            {
                let me=this;
                var url="/api/producto/getdata?idBuscar=" + this.idProducto;

                axios.get(url)
                .then(function(response){
                    var respuesta=response.data;
                    me.arrayDetalleProducto=respuesta.consulta;
                    me.valor=me.arrayDetalleProducto[0]['price'];
                })
                .catch(function(error){
                })
            },
            agregarDetalleProd()
            {
                var total=this.cantidad*this.arrayDetalleProducto[0]['price'];
                this.arrayDetallePedido.push({id_detail:"",
                                              id_order:"",
                                              product_code:this.arrayDetalleProducto[0]['id'],
                                              name:this.arrayDetalleProducto[0]['name'],
                                              units:this.cantidad,
                                              unit_price:this.arrayDetalleProducto[0]['price'],
                                              total:total});
                this.idProducto="";
                this.cantidad=0;
                this.valor=0;
            },
            getDetallePedido()
            {
                var arrayDetPed=[];
                let me=this;
                var url="/api/detalle/getdata?idBuscar=" + this.idPedido;

                axios.get(url)
                .then(function(response){
                    var respuesta=response.data;
                    me.arrayDetallePedido=respuesta.consulta;
                })
                .catch(function(error){
                })
                
            },
        },
        computed: {
            sumar:function()
            {
                var sumar=0;
                for(var i=0;i<this.arrayDetallePedido.length;i++)
                {
                    sumar+= parseInt(this.arrayDetallePedido[i].total);
                }
                return sumar;

            }

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
