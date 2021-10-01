<template>
    <app-layout title="Documento">
        <template #header>
            <h2 class="text-center font-semibold text-xl text-pink-800 leading-tight">
                Tipo de Documento
            </h2>
        </template>
        <!-- component -->
        <div class="overflow-x-auto">
            <div class="min-w-screen min-h-screen bg-red-50 flex justify-center bg-red-50 font-sans overflow-hidden">
                <div class="w-full lg:w-5/6">
                    <div class="bg-white shadow-md rounded my-6" v-if="modal==false">
                        <table class="min-w-max w-full table-auto">
                            <thead>
                                <tr class="bg-pink-100 text-pink-900 uppercase text-sm leading-normal">
                                    <th class="py-3 px-6 text-left">Tipo Documento</th>
                                    <th class="py-3 px-6 text-left">Acción</th>
                                </tr>
                            </thead>
                            <tbody class="text-gray-600 text-sm font-light">
                                <tr v-for="(object, index) in this.arrayDatos" :key="index" class="border-b border-blue-100 hover:bg-gray-100">
                                    <td class="py-3 px-6 text-left">
                                        <div class="flex items-center">
                                            <span>{{ object.doc_type }}</span>
                                        </div>
                                    </td>
                                    <td class="py-3 px-6 text-center w-24">
                                        <div class="flex item-left justify-left">
                                            <div class="w-4 mr-2 transform hover:text-purple-500 hover:scale-110" title="Ver" @click="ver(object)">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                                </svg>
                                            </div>
                                            <div class="w-4 mr-2 transform hover:text-green-500 hover:scale-110" title="Editar" @click="actualizar(object)">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                                                </svg>
                                            </div>
                                            <div class="w-4 mr-2 transform hover:text-red-500 hover:scale-110" title="Eliminar" @click="eliminar(object)">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                </svg>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="bg-red-50 overflow-hidden shadow-x2 sm:rounded-lg">
                            <button @click="abrirModal" type="button" class="border border-pink-600 bg-pink-700 text-white rounded-md px-4 py-2 m-2 transition duration-500 ease select-none hover:bg-pink-500 focus:outline-none focus:shadow-outline">
                                Nuevo
                            </button>
                        </div>        
                    </div>
                    <!-- Modal -->
                    <div class="flex justify-center items-top bg-red-50 antialiased" v-if="modal==true">
                        <div class="flex flex-col w-11/12 sm:w-5/6 lg:w-1/2 max-w-2xl mx-auto rounded-lg border border-gray-300 shadow-xl">
                            <div class="flex flex-row justify-between p-6 bg-pink-100 border-b border-gray-200 rounded-tl-lg rounded-tr-lg">
                                <p class="font-semibold text-gray-800">{{titulo}}</p>
                                <button @click="cerrarModal" class="px-4 py-2 text-white font-semibold bg-red-500 uppercase  rounded">X</button>
                            </div>
                            <div class="flex flex-col px-6 py-5 bg-gray-50">
                                <div class="mb-3 space-y-2 w-full">
                                    <label class="text-pink-700 select-none font-medium">Tipo Documento</label>
                                    <input v-model="nombre"  placeholder="Ingrese tipo documento" class="appearance-none block w-full bg-grey-lighter text-grey-darker border border border-gray-300 rounded text-gray-600 h-10 pl-5 pr-10" required="required" type="text" name="integration[shop_name]" id="integration_shop_name">
                                    <p class="text-red text-xs hidden">Please fill out this field.</p>
                                </div>
                            </div>
                            <div class="flex flex-row items-center justify-between p-5 text-gray-600 border-t border-gray-200 rounded-bl-lg rounded-br-lg">
                                <button @click="cerrarModal" class="px-4 py-2 text-white font-semibold bg-purple-600 rounded">
                                    Cancelar
                                </button>
                                <button v-if="tpAccion==0" @click="registrar" class="px-4 py-2 text-white font-semibold bg-green-400 rounded">
                                    Guardar
                                </button>
                                <button v-if="tpAccion==1" @click="update" class="px-4 py-2 text-white font-semibold bg-green-400 rounded">
                                    Actualizar
                                </button>
                            </div>
                        </div>
                    </div>
                    <!-- Modal -->

                    <!-- eliminar -->
                    <div v-if="tpAccion==2">
                        <div class="bg-opacity-25 flex flex-col space-y-4 min-w-screen h-screen animated fadeIn faster  fixed  left-0 top-0 flex justify-center items-center inset-0 z-50 outline-none focus:outline-none bg-gray-600">
                            <div class="flex flex-col p-8 bg-white shadow-md hover:shodow-lg rounded-2xl">
                                <div class="flex items-center justify-between">
                                    <div class="flex items-center">
                                        <svg xmlns="http://www.w3.org/2000/svg"
                                            class="w-16 h-16 rounded-2xl p-3 border border-blue-100 text-blue-400 bg-blue-50" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                        </svg>
                                        <div class="flex flex-col ml-3">
                                            <div class="font-medium leading-none">
                                                Desea eliminar este registro ?
                                            </div>
                                            <p class="text-sm text-gray-600 leading-none mt-1">Este proceso no es reversible esta seguro?</p>
                                        </div>
                                    </div>
                                    <button @click="confirmar" class="flex-no-shrink bg-red-500 px-5 ml-4 py-2 text-sm shadow-sm hover:shadow-lg font-medium tracking-wider border-2 border-red-500 text-white rounded-full">SI</button>
                                    <button @click="confirmarNo" class="flex-no-shrink bg-gray-800 px-5 ml-4 py-2 text-sm shadow-sm hover:shadow-lg font-medium tracking-wider border-2 border-gray-900 text-white rounded-full">NO</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- eliminar -->
                </div>
            </div>
        </div>
    </app-layout>
</template>

<script>
    import { defineComponent } from 'vue'
    import AppLayout from '@/Layouts/AppLayout.vue'
    import Welcome from '@/Jetstream/Welcome.vue'

    export default defineComponent({
        components: {
            AppLayout
        },
        data() 
        {
            return{
                modal: false,
                titulo : "",
                tpAccion: 1,//1 guardar 0 actualizar
                nombre:"",
                idTpDocumento:"",
                arrayDatos:[]
            };
        },
        methods:
        {
            abrirModal()
            {
                this.titulo = "Nuevo Registro"
                this.modal = true;
                this.tpAccion=0;
                this.limpiar();
            },
            registrar()
            {     
                let me=this;
                var url="/api/tipodoc/registrar";
                axios.post(url, 
                {
                    tipo:this.nombre.toUpperCase()
                })
                .then(function(response)
                {
                    me.listarDatos();
                    me.limpiar();
                    me.cerrarModal();
                    alert("Se registro correctamente");
                })
                .catch(function(error) 
                {
                    alert(error);
                });
            },
            limpiar()
            {
                this.nombre="";
            },
            nuevo()
            {
                this.titulo = "Nuevo Registro";
                this.modal = true;
                this.tpAccion=0;
            },    
            ver()
            {
                this.titulo = "Ver Registro";
                this.modal = true;
            },    
            update()
            {
                let me=this;
                var url="/api/tipodoc/actualizar";
                axios.put(url, {
                    id:this.idTpDocumento,
                    tipo:this.nombre
                })
                .then(function(response) {
                    me.listarDatos();      
                    alert("Se actualizo correctamente");
                })
                .catch(function(error) {
                    alert(error);
                });
            }, 
            actualizar(data=[])
            {
                this.idTpDocumento=data['id'];
                this.nombre=data['doc_type'];
                this.modal = true;
                this.tpAccion=1;
                this.titulo = "Actualizar Registro"
            },
            delete()
            {
                let me=this;
                var url="/api/tipodoc/eliminar" ;
                axios.post(url,{
                    id:this.idTpUsuario
                })
                .then(function(response) {
                    me.listarDatos();
                    alert("Se elimino correctamente");        
                })
                .catch(function(error) {
                    alert(error);
                })
            },
            eliminar(data=[]){
                this.idTpUsuario=data['id'];
                this.tpAccion=2;
            },
            cerrarModal()
            {
                this.modal = false;
            },
            listarDatos()
            {
                let me=this;
                var url="/api/tipodoc/index2";

                axios.get(url)
                .then(function(response)
                {
                    var respuesta=response.data;
                    me.arrayDatos=respuesta.consulta;
                })
                .catch(function(error){
                })
            },
            confirmar()
            {
                this.delete();
                this.tpAccion=0;
            },
            confirmarNO()
            {
                this.tpAccion=0;
            }
        },
        mounted()
        {
            this.listarDatos();
        },
        props: ['consulta'],
    })
</script>
