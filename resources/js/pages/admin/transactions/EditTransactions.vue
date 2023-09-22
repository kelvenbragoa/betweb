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
let typeoperations =ref([]);
const province_id_to_city = ref(0);
let loadingButtonSubmit =ref([false]);
let loadingDiv =ref([true]);
const toastr = useToastr();
const router = useRouter();
let self = this;
let currentvalue = ref([]);




const schema = yup.object({
    start_date: yup.string().required(),
    end_date: yup.string().required(),
    status: yup.string().required(),
    type_operation_id: yup.string().required(),
  });







const getData = () => {
  axios.get(`/transactions/+${router.currentRoute.value.params.id}/edit`)
       .then((response)=>{

        retrievedData.value = response.data.transaction;
        typeoperations.value = response.data.typeoperations;
        loadingDiv.value=false;

       }).catch(()=>{

        loadingDiv.value=false;

       })
}

const editFunction = (values, actions) => {

  loadingButtonSubmit.value = true;
  axios.patch(`/transactions/${retrievedData.value.id}`,values).then((response)=>{

    actions.resetForm();
    router.push({ path: '/admin/transactions' });
    toastr.success('Transação editada com sucesso');

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

        <h1 class="h3 mb-3">Transação </h1>
        
                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-header">
                                        <h5 class="card-title">Transação: {{ retrievedData.name }}</h5>

                                        <router-link to="/admin/transactions" class="btn btn-pill btn-primary mt-3"><vue-feather type="arrow-left"></vue-feather>Voltar</router-link> 

                                       
								    </div>
                                    
                                    <div class="card-body">
                                          
                                        <div class="row">
                                            <div class="col-xl-12 col-xxl-12 d-flex">
                                                <div class="w-100">
                                                    <Form @submit="editFunction" :validation-schema="schema" v-slot="{ errors }">

                                                        <div class="row">
                                                            <div class="mb-3 col-md-12">
                                                                <label class="form-label" for="start_date">
                                                                    Estado:
                                                                    <span v-if="retrievedData.status == 0" class="badge bg-warning">
                                                                        Aguardando Aprovação
                                                                    </span>
                                                                    <span v-if="retrievedData.status == 1" class="badge bg-success">
                                                                        Em andamento
                                                                    </span>
                                                                    <span v-if="retrievedData.status == 2" class="badge bg-danger">
                                                                        Expirou
                                                                    </span>   
                                                                
                                                                </label>
                                                                
                                                            </div>
                                                           
                                                        </div>

                                                        <div class="row">
                                                            <div class="mb-3 col-md-12">
                                                                <label class="form-label" for="start_date">Data de Inicio</label>
                                                                <Field type="date" class="form-control" :class="{'is-invalid':errors.start_date}" v-model="retrievedData.start_date" name="start_date" id="start_date" placeholder="Data de Inicio"/>
                                                                <span class="invalid-feedback">{{ errors.start_date }}</span>
                                                            </div>
                                                           
                                                        </div>
                                                        <div class="row">
                                                            <div class="mb-3 col-md-12">
                                                                <label class="form-label" for="end_date">Data de Fim</label>
                                                                <Field type="date" class="form-control" :class="{'is-invalid':errors.end_date}" v-model="retrievedData.end_date" name="end_date" id="end_date" placeholder="Data de Fim"/>
                                                                <span class="invalid-feedback">{{ errors.end_date }}</span>
                                                            </div>
                                                           
                                                        </div>

                                                        <div class="row">
													
                                                        <div class="mb-3 col-md-12">
                                                            <label class="form-label" for="type_operation_id">Tipo de Operação</label>
                                                            <Field as="select" class="form-control" :class="{'is-invalid':errors.type_operation_id}"  name="type_operation_id" id="type_operation_id" v-model="retrievedData.type_operation_id" aria-describedby="type_operation_id">
                                                                <option value="" disabled>Selecionar</option>
                                                                <option v-for="typeoperation in typeoperations" :key="typeoperation.id" :value="typeoperation.id">{{ typeoperation.name }}</option>
                                                            </Field>
                                                            <span class="invalid-feedback">{{ errors.type_operation_id }}</span>
                                                        </div>
                                                        </div>

                                                        <div class="row">
                                                            <div class="mb-3 col-md-12">
                                                                <label class="form-label" for="end_date">Número de Estivadores: {{ retrievedData.stevedors.length }} </label>
                                                                
                                                            </div>
                                                           
                                                        </div>

                                                        

                                                        <hr>

                                                        <div class="table-responsive">
                                                            <table class="table table-striped">
                                                                <thead>
                                                                    <tr>
                                                                        <th>#</th>
                                                                        <th>Nome</th>
                                                                        <th>Contacto</th>
                                                                        <th>Documento</th>
                                                                        <th>Empresa</th>
                                                                    
                                                                    </tr>
                                                                </thead>
                                                                <tbody v-if="retrievedData.stevedors.length > 0">
                                                                    <tr  v-for="(actualData,index) in retrievedData.stevedors" :key="actualData.id">
                                                                        <td>#{{ index + 1 }}</td>
                                                                        <td>{{ actualData.stevedor.name}}</td>
                                                                        <td>{{ actualData.stevedor.contact}}</td>
                                                                        <td>{{ actualData.stevedor.document}}</td>
                                                                        <td>{{ retrievedData.company.name }}</td>
                        
                                                                    
                                                                    </tr>
                                                                </tbody>
                                                                <tbody v-else>
                                                                    <tr>
                                                                    <td colspan="5" align="center">Nenhum resultado encontrado</td>
                                                                    </tr>
                                                                </tbody>
                                                            </table>
                                                        </div>

                                                        <hr>

                                                        <div class="mb-3 col-md-12">
                                                            <label class="form-label" for="status">Estado</label>
                                                            <Field as="select" class="form-control" :class="{'is-invalid':errors.status}"  name="status" id="status" v-model="retrievedData.status" aria-describedby="status">
                                                                <option value="0">Aguardando Aprovação</option>
                                                                <option value="1">Em andamento</option>
                                                                
                                                            </Field>
                                                            <span class="invalid-feedback">{{ errors.status }}</span>
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