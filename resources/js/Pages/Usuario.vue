<template>
    <app-layout title="Usuario">
        <template #header>
            <h2 class="text-center font-semibold text-xl text-pink-800 leading-tight">
                Usuarios 
            </h2>
        </template>
        <div class="overflow-x-auto">
            <div class="min-w-screen min-h-screen bg-red-50 flex justify-center bg-red-50 font-sans overflow-hidden">
                <div class="w-full lg:w-5/6">
                    <div class="bg-white shadow-md rounded my-6" v-if="modal==false">
                        <table class="min-w-max w-full table-auto">
                            <thead>
                                <tr class="bg-pink-100 text-pink-900 uppercase text-sm leading-normal">
                                    <th class="py-3 px-6 text-left">Tipo</th>
                                    <th class="py-3 px-6 text-left">Número Documento</th>
                                    <th class="py-3 px-6 text-left">Nombres</th>
                                    <th class="py-3 px-6 text-left">Apellidos</th>
                                    <th class="py-3 px-6 text-left">Teléfono</th>
                                    <th class="py-3 px-6 text-left">Dirección</th>
                                    <th class="py-3 px-6 text-left">Email</th>
                                    <th class="py-3 px-6 text-left">Rol</th>
                                    <th class="py-3 px-6 text-left">Acción</th>
                                </tr>
                            </thead>
                            <tbody class="text-gray-600 text-sm font-light">
                                <tr v-for="(object, index) in this.arrayDatos" :key="index" class="border-b border-blue-100 hover:bg-gray-100">
                                    <td class="py-3 px-6 text-left">
                                        <div class="flex items-center">
                                            <span>{{ object.type }}</span>
                                        </div>
                                    </td>
                                    <td class="py-3 px-6 text-left">
                                        <div class="flex items-center">
                                            <span>{{ object.doc_num }}</span>
                                        </div>
                                    </td>
                                    <td class="py-3 px-6 text-left">
                                        <div class="flex items-center">
                                            <span>{{ object.names }}</span>
                                        </div>
                                    </td>
                                    <td class="py-3 px-6 text-left">
                                        <div class="flex items-center">
                                            <span>{{ object.surnames }}</span>
                                        </div>
                                    </td>
                                    <td class="py-3 px-6 text-left">
                                        <div class="flex items-center">
                                            <span>{{ object.phone }}</span>
                                        </div>
                                    </td>
                                    <td class="py-3 px-6 text-left">
                                        <div class="flex items-center">
                                            <span>{{ object.address }}</span>
                                        </div>
                                    </td>
                                    <td class="py-3 px-6 text-left">
                                        <div class="flex items-center">
                                            <span>{{ object.email }}</span>
                                        </div>
                                    </td>
                                    <td class="py-3 px-6 text-left">
                                        <div class="flex items-center">
                                            <span>{{ object.tip_user }}</span>
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
                        <div class="bg-pink-100 overflow-hidden shadow-x2">
                            <button 
                                @click="abrirModal"
                                type="button"
                                class="border border-pink-600 bg-pink-700 text-white rounded-md px-4 py-2 m-2 transition duration-500 ease select-none hover:bg-pink-500 focus:outline-none focus:shadow-outline"
                            >
                                Nuevo Usuario
                            </button>
                        </div>
                    </div>
                    <!-- component -->
                    <div class="flex justify-center items-top bg-red-50 antialiased" v-if="modal==true">

                        <div class="max-w-4xl p-6 mx-auto bg-pink-100 rounded-md shadow-md dark:bg-gray-800 mt-20">
                            <h1 class="text-xl font-bold text-pink-900 capitalize dark:text-white">{{titulo}}</h1>
                            <div>
                                <div class="grid grid-cols-1 gap-6 mt-4 sm:grid-cols-2">
                                    <div>
                                        <label class="text-pink-800 dark:text-gray-200" for="passwordConfirmation">Tipo Documento</label>
                                        <select v-model="idTipoDoc" class="block w-full px-4 py-2 mt-2 text-gray-700 bg-white border border-gray-300 rounded-md dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 focus:border-blue-500 dark:focus:border-blue-500 focus:outline-none focus:ring">
                                            <option v-for="item in arrayTipoDoc" :key="item.id" :value="item.id">{{ item.doc_type }}</option>
                                        </select>
                                    </div>
                                    <div>
                                        <label class="text-pink-800 dark:text-gray-200" for="username">Numero Documento</label>
                                        <input v-model="numdoc" id="numdoc" type="text" class="block w-full px-4 py-2 mt-2 text-gray-700 bg-white border border-gray-300 rounded-md dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 focus:border-blue-500 dark:focus:border-blue-500 focus:outline-none focus:ring">
                                    </div>
                                    <div>
                                        <label class="text-pink-800 dark:text-gray-200" for="username">Nombres</label>
                                        <input v-model="nombres" id="username" type="text" class="block w-full px-4 py-2 mt-2 text-gray-700 bg-white border border-gray-300 rounded-md dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 focus:border-blue-500 dark:focus:border-blue-500 focus:outline-none focus:ring">
                                    </div>
                                    <div>
                                        <label class="text-pink-800 dark:text-gray-200" for="username">Apellidos</label>
                                        <input v-model="apellidos" id="usersurname" type="text" class="block w-full px-4 py-2 mt-2 text-gray-700 bg-white border border-gray-300 rounded-md dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 focus:border-blue-500 dark:focus:border-blue-500 focus:outline-none focus:ring">
                                    </div>

                                    <div>
                                        <label class="text-pink-800 dark:text-gray-200" for="emailAddress">Teléfono</label>
                                        <input v-model="telefono" id="phone" type="text" class="block w-full px-4 py-2 mt-2 text-gray-700 bg-white border border-gray-300 rounded-md dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 focus:border-blue-500 dark:focus:border-blue-500 focus:outline-none focus:ring">
                                    </div>

                                    <div>
                                        <label class="text-pink-800 dark:text-gray-200" for="emailAddress">Correo electronico</label>
                                        <input v-model="email" id="emailAddress" type="email" class="block w-full px-4 py-2 mt-2 text-gray-700 bg-white border border-gray-300 rounded-md dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 focus:border-blue-500 dark:focus:border-blue-500 focus:outline-none focus:ring">
                                    </div>

                                    <div>
                                        <label class="text-pink-800 dark:text-gray-200" for="emailAddress">Dirección</label>
                                        <input v-model="direccion" id="Address" type="text" class="block w-full px-4 py-2 mt-2 text-gray-700 bg-white border border-gray-300 rounded-md dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 focus:border-blue-500 dark:focus:border-blue-500 focus:outline-none focus:ring">
                                    </div>

                                    <div>
                                        <label class="text-pink-800 dark:text-gray-200" for="passwordConfirmation">Tipo Usuario</label>
                                        <select v-model="idTipoUsuario" class="block w-full px-4 py-2 mt-2 text-gray-700 bg-white border border-gray-300 rounded-md dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 focus:border-blue-500 dark:focus:border-blue-500 focus:outline-none focus:ring">
                                            <option v-for="item in arrayTipoUsuario" :key="item.id" :value="item.id">{{ item.name }}</option>
                                        </select>
                                    </div>
                                    <br/>
                                </div>
                                <div class="flex flex-row items-center justify-between p-5 text-gray-600 border-t border-gray-200 rounded-bl-lg rounded-br-lg">
                                    <button @click="cerrarModal" class="px-6 py-2 leading-5 text-white transition-colors duration-200 transform bg-pink-700 rounded-md hover:bg-pink-600 focus:outline-none focus:bg-pink-600">
                                        Cancelar
                                    </button>
                                    <button v-if="tpAccion==0" @click="registrar" class="px-6 py-2 leading-5 text-white transition-colors duration-200 transform bg-green-500 rounded-md hover:bg-green-400 focus:outline-none focus:bg-green-400">
                                        Guardar
                                    </button>
                                    <button v-if="tpAccion==1" @click="update" class="px-6 py-2 leading-5 text-white transition-colors duration-200 transform bg-purple-700 rounded-md hover:bg-purple-600 focus:outline-none focus:bg-purple-600">
                                        Actualizar
                                    </button>
                                </div>

                            </div>
                        </div>
                    </div>
                    <!-- component -->
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
                                    <button @click="confirmarNO" class="flex-no-shrink bg-gray-800 px-5 ml-4 py-2 text-sm shadow-sm hover:shadow-lg font-medium tracking-wider border-2 border-gray-900 text-white rounded-full">NO</button>
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
   
    import { defineComponent } from "vue";
    import AppLayout from '@/Layouts/AppLayout.vue';
    import Welcome from '@/Jetstream/Welcome.vue';

	function setup() {
    return {
      activeTab: 0,
      tabs: [
          "Tab No.1",
          "Tab No.2",
          "Tab No.3",
          "Tab No.4",
      ]
    };
  };

export default defineComponent(
    {
        components: 
        {
            AppLayout
        },
        data() 
        {
            return {
                modal: false,
                titulo:"",
                tpAccion:1,//1 guardar 0 actualizar
                idTipoDoc:"",
                numdoc:"",
                nombres:"",
                apellidos:"",
                telefono:"",
                email:"",
                direccion:"",
                idUsuario:"",
                arrayDatos:[],
                arrayTipoDoc:[],
                arrayTipoUsuario:[],
                titulo:"",
            };
        },
        methods: {
            listarDatos()
            {
                let me=this;
                var url="/api/user/index2";

                axios.get(url)
                .then(function(response){
                    var respuesta=response.data;
                    me.arrayDatos=respuesta.consulta;
                })
                .catch(function(error){
                })
            },
            abrirModal()
            {
                let me=this;
                this.titulo = "Creacion Usuario"
                this.modal = true;
                this.tpAccion=0;
                this.limpiar();
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
            listarTipoUsuario()
            {
                let me=this;
                var url="/api/tipouser/getdata";

                axios.get(url)
                .then(function(response){
                    var respuesta=response.data;
                    me.arrayTipoUsuario=respuesta.consulta;
                })
                .catch(function(error){
                })
            },
            ver(data=[]){
                this.idUsuario=data['id'];
                this.idTipoDoc=data['idDoc'];
                this.numdoc=data['doc_num'];
                this.nombres=data['names'];
                this.apellidos=data['surnames'];
                this.telefono=data['phone'];
                this.email=data['email'];
                this.direccion=data['address'];
                this.idTipoUsuario=data['idUser'];
                this.modal = true;
                this.tpAccion=-1;
                this.titulo = "Ver Usuario"
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
                this.idTipoUsuario="";
            },    
            registrar(){     
                let me=this;
                var url="/api/user/registrar";
                axios.post(url, 
                {
                    doc_type:this.idTipoDoc,
                    doc_num:this.numdoc,
                    names:this.nombres,
                    surnames:this.apellidos,
                    phone:this.telefono,
                    address:this.direccion,
                    email:this.email,
                    id_type_user:this.idTipoUsuario
                })
                .then(function(response)
                {
                    me.mensaje('Registro creado!!','El registro se creo correctamente.','success');
                })
                .catch(function(error) 
                {
                me.mensaje('Error al crear Registro!!',error.message,'error');
                });
            },
            mensaje(head, body, button){
                Swal.fire(
                    head,
                    body,
                    button
                )            
            },
            cerrarModal()
            {
                this.modal = false;
            },
            actualizar(data=[])
            {
                this.idUsuario=data['id'];
                this.idTipoDoc=data['idDoc'];
                this.numdoc=data['doc_num'];
                this.nombres=data['names'];
                this.apellidos=data['surnames'];
                this.telefono=data['phone'];
                this.email=data['email'];
                this.direccion=data['address'];
                this.idTipoUsuario=data['idUser'];
                this.modal = true;
                this.tpAccion=1;
                this.titulo = "Actualizar Registro";
            },
            update()
            {
                let me=this;
                var url="/api/user/actualizar";
                axios.put(url, {
                    id:this.idUsuario,
                    doc_type:this.idTipoDoc,
                    doc_num:this.numdoc,
                    names:this.nombres,
                    surnames:this.apellidos,
                    phone:this.telefono,
                    address:this.direccion,
                    email:this.email,
                    id_type_user:this.idTipoUsuario
                })
                .then(function(response) {
                    me.listarDatos();     
                    me.mensaje('Registro actualizado!!','El registro se actualizo correctamente.','success'); 
                })
                .catch(function(error) {
                    me.mensaje('Error al actualizar!!',error.message,'success');
                });
            }, 
            eliminar(data=[]){
                this.idUsuario=data['id'];
                this.tpAccion=2;
            },
            confirmar()
            {
                this.delete();
                this.tpAccion=0;
            },
            confirmarNO()
            {
                this.tpAccion=0;
            },
            delete()
            {
                let me=this;
                var url="/api/user/eliminar" ;
                axios.post(url,{
                    id:this.idUsuario
                })
                .then(function(response) {
                    me.listarDatos();
                    me.mensaje('Registro eliminado!!','El registro se elimino exitosamente.','success');       
                })
                .catch(function(error) {
                    me.mensaje('Error al eliminar!!',error.message,'success');
                })
            },
        },
        mounted()
        {
            this.listarDatos();
            this.listarTipoDoc();
            this.listarTipoUsuario();
        }
    });
</script>
