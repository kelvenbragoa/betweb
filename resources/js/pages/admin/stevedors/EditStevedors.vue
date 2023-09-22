<script setup>

import axios from 'axios';
import { ref, onMounted, reactive, defineEmits, defineComponent,watch } from "vue";
import moment from 'moment'
import {useToastr} from '../../../toastr';
import {debounce} from 'lodash';
import {Form, Field} from 'vee-validate';
import { useRouter} from "vue-router";
import * as yup from 'yup';
import VueFeather from 'vue-feather';
import { Bootstrap4Pagination } from 'laravel-vue-pagination';

let retrievedData =ref([]);
let roles =ref([]);
let areas =ref([]);
let provinces =ref([]);
let cities =ref([]);
let user_statuses =ref([]);
let account_statuses =ref([]);
const province_id_to_city = ref(0);
let loadingButtonSubmit =ref([false]);
let loadingDiv =ref([true]);
const toastr = useToastr();
const router = useRouter();
let self = this;
let currentvalue = ref([]);




const schema = yup.object({
    name: yup.string().required(),
    document: yup.string().required(),
    contact: yup.string().required(),
  });







const getData = () => {
  axios.get(`/stevedors/+${router.currentRoute.value.params.id}/edit`)
       .then((response)=>{

        retrievedData.value = response.data.stevedor;
        loadingDiv.value=false;

       }).catch(()=>{

        loadingDiv.value=false;

       })
}

const editFunction = (values, actions) => {

  loadingButtonSubmit.value = true;
  axios.patch(`/stevedors/${retrievedData.value.id}`,values).then((response)=>{

    actions.resetForm();
    router.push({ path: '/admin/stevedors' });
    toastr.success('Estivador editada com sucesso');

  }).catch((error)=>{
    loadingButtonSubmit.value = false;
    toastr.error('Erro ao editar');
    if(error.response.data.errors){
      actions.setErrors(error.response.data.errors);
    }

  }).finally(()=>{
    loadingButtonSubmit.value = false;
  })
};





onMounted(()=>{
  
  getData();

})
</script>

<template>
    <div v-if="!loadingDiv">

        <h1 class="h3 mb-3">Estivador </h1>
        
                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-header">
                                        <h5 class="card-title">Estivador: {{ retrievedData.name }}</h5>

                                        <router-link to="/admin/stevedors" class="btn btn-pill btn-primary mt-3"><vue-feather type="arrow-left"></vue-feather>Voltar</router-link> 

                                       
								    </div>
                                    
                                    <div class="card-body">
                                          
                                        <div class="row">
                                            <div class="col-xl-12 col-xxl-12 d-flex">
                                                <div class="w-100">
                                                    <Form @submit="editFunction" :validation-schema="schema" v-slot="{ errors }">

                                                        <div class="row">
                                                            <div class="mb-3 col-md-12">
                                                                <label class="form-label" for="name">Nome</label>
                                                                <Field type="text" class="form-control" :class="{'is-invalid':errors.name}" v-model="retrievedData.name" name="name" id="name" placeholder="Nome"/>
                                                                <span class="invalid-feedback">{{ errors.name }}</span>
                                                            </div>
                                                           
                                                        </div>
                                                        <div class="row">
                                                            <div class="mb-3 col-md-12">
                                                                <label class="form-label" for="contact">Contacto</label>
                                                                <Field type="text" class="form-control" :class="{'is-invalid':errors.contact}" v-model="retrievedData.contact" name="contact" id="contact" placeholder="Contacto"/>
                                                                <span class="invalid-feedback">{{ errors.contact }}</span>
                                                            </div>
                                                           
                                                        </div>
                                                        <div class="row">
                                                            <div class="mb-3 col-md-12">
                                                                <label class="form-label" for="document">Documento</label>
                                                                <Field type="text" class="form-control" :class="{'is-invalid':errors.document}" v-model="retrievedData.document" name="document" id="document" placeholder="Documento"/>
                                                                <span class="invalid-feedback">{{ errors.document }}</span>
                                                            </div>
                                                           
                                                        </div>

                                                    
                                                       
                                                     
                                                      
                                                  
												
                                                        <button type="submit" class="btn btn-primary" :disabled="loadingButtonSubmit == true">
                                                            <div v-if="loadingButtonSubmit == true" class="spinner-border spinner-border-sm" role="status"></div>
                                                            <span v-else>Submeter</span>
                                                        </button>


                                                    </Form>
                                                    
                                            
                                                
                                                </div>
                                            </div>
                                        </div>
                                    </div>
								</div>
                            </div>   
                        </div>
                    </div>
    <div v-else>
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-center">
                    <div class="spinner-border" role="status">
                        <span class="sr-only"></span>
                    </div>
                </div>
                <br>
                <div class="d-flex justify-content-center">
                    Carregando Dados...
                </div>
            </div> 
        </div>
    </div>
</template>