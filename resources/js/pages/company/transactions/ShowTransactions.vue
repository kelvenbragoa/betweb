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
let loadingSubmit =ref([true]);
let loadingDiv =ref([true]);
const router = useRouter();
let self = this;







const getData = () => {
  axios.get(`/company-transactions/+${router.currentRoute.value.params.id}`)
       .then((response)=>{
        loadingDiv.value=false;
        retrievedData.value = response.data;
       }).catch(()=>{
        loadingDiv.value=false;
       })
}




onMounted(()=>{
  
  getData();
})
</script>

<template>
    <div v-if="!loadingDiv">

        <h1 class="h3 mb-3">Transação</h1>
        
                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-header">
                                        <h5 class="card-title">Transação</h5>

                                        <router-link to="/company/transactions" class="btn btn-pill btn-primary mt-3"><vue-feather type="arrow-left"></vue-feather>Voltar</router-link> 
								    </div>
                                    
                                    <div class="card-body">
                                          
                                        <div class="row">
                                            <div class="col-xl-12 col-xxl-12 d-flex">
                                                <div class="w-100">
                                                    <p>Nome da Empresa: {{ retrievedData.company.name }}</p>
                                                    <p>Data de Inicio: {{ retrievedData.start_date }}</p>
                                                    <p>Data de Fim: {{ retrievedData.end_date }}</p>
                                                    <p>Número de Estivadores: {{ retrievedData.stevedors.length }}</p>  
                                                    <p>Estado: 
                                                        <span v-if="retrievedData.status == 0" class="badge bg-warning">
                                                                Aguardando Aprovação
                                                            </span>
                                                            <span v-if="retrievedData.status == 1" class="badge bg-success">
                                                                Em andamento
                                                            </span>
                                                            <span v-if="retrievedData.status == 2" class="badge bg-danger">
                                                                Expirou
                                                            </span>  
                                                    </p>
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