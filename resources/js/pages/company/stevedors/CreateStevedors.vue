<script setup>

import {onMounted, ref, reactive,watch} from 'vue';
import axios from 'axios';
import {useToastr} from '../../../toastr';
import {Form, Field} from 'vee-validate';
import * as yup from 'yup';
import { useRouter } from "vue-router";
import moment from 'moment'
import {debounce} from 'lodash';
import { Bootstrap4Pagination } from 'laravel-vue-pagination';
import VueFeather from 'vue-feather';

const loading = ref(false);
const toastr = useToastr();
let companies =ref([]);
let currentvalue = ref([]);
const loadingDiv = ref(false);
const user_role = ref(0);

const schema = yup.object({
    
  name: yup.string().required(),
  contact: yup.string().required(),
  document: yup.string().required(),

});
let self = this;
const router = useRouter();

const createRecordFunction = (values, actions) => {

    currentvalue.value = {values};
    loading.value = true;
    const arr = Array.from(values)
    axios.post('/company-stevedors',values).then((response)=>{

    actions.resetForm();
    router.push({ path: '/company/stevedors' });
    toastr.success('Estivador criado com sucesso');

  }).catch((error)=>{

    loading.value = false;
    toastr.error('Erro ao adicionar. '+error.response.data.message);
    if(error.response.data.errors){

        actions.setErrors(error.response.data.errors);

    }
  }).finally(()=>{

    loading.value = false;
  })
};







</script>

<template>
    <div v-if="!loadingDiv">
        <h1 class="h3 mb-3">Estivadores</h1>
        
                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-header">
                                        <h5 class="card-title">Formulário criação dos Estivadors do sistema.</h5>

                                        <router-link to="/company/stevedors" class="btn btn-pill btn-primary mt-3"><vue-feather type="arrow-left"></vue-feather>Voltar</router-link> 

                                       
								    </div>
                                    
                                    <div class="card-body">
                                            <Form @submit="createRecordFunction" :validation-schema="schema" v-slot="{ errors }">
												<div class="row">
													<div class="mb-3 col-md-12">
														<label class="form-label" for="name">Nome</label>
														<Field type="text" class="form-control" :class="{'is-invalid':errors.name}" name="name" id="name" placeholder="Nome"/>
                                                        <span class="invalid-feedback">{{ errors.name }}</span>
													</div>
													
												</div>
                                                <div class="row">
													<div class="mb-3 col-md-12">
														<label class="form-label" for="document">Documento</label>
														<Field type="text" class="form-control" :class="{'is-invalid':errors.document}" name="document" id="document" placeholder="Documeto"/>
                                                        <span class="invalid-feedback">{{ errors.document }}</span>
													</div>
													
												</div>
                                                <div class="row">
													<div class="mb-3 col-md-12">
														<label class="form-label" for="contact">Contacto</label>
														<Field type="text" class="form-control" :class="{'is-invalid':errors.contact}" name="contact" id="contact" placeholder="Contacto"/>
                                                        <span class="invalid-feedback">{{ errors.contact }}</span>
													</div>
													
												</div>

                                               
    
												<button type="submit" class="btn btn-primary" :disabled="loading">
                                                    <div v-if="loading" class="spinner-border spinner-border-sm" role="status"></div>
                                                    <span v-else>Submeter</span>
                                                </button>
											</Form>

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