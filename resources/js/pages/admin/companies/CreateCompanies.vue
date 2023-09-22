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
let roles =ref([]);
let currentvalue = ref([]);
const loadingDiv = ref(true);
const user_role = ref(0);

const schema = yup.object({
    
  name: yup.string().required(),
  username: yup.string().required(),
  email: yup.string().email().required(),
  password: yup.string().required().min(8),
  role_id: yup.string().required(),
});
let self = this;
const router = useRouter();

const createRecordFunction = (values, actions) => {

    currentvalue.value = {values};
    loading.value = true;
    const arr = Array.from(values)
    axios.post('/companies',values).then((response)=>{

    actions.resetForm();
    router.push({ path: '/admin/companies' });
    toastr.success('Empresa criado com sucesso');

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



const getAuxiliarData = () => {

  axios.get('/auxiliar-create-companies')
       .then((response)=>{

        roles.value = response.data.roles;
        loadingDiv.value=false;

       })
       .catch((error)=>{
        toastr.error(error);
        router.push({ path: '/admin/companies' });
       })
}



onMounted(()=>{
    getAuxiliarData()
})
</script>

<template>
    <div v-if="!loadingDiv">
        <h1 class="h3 mb-3">Empresas</h1>
        
                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-header">
                                        <h5 class="card-title">Formulário criação dos Empresas do sistema.</h5>

                                        <router-link to="/admin/companies" class="btn btn-pill btn-primary mt-3"><vue-feather type="arrow-left"></vue-feather>Voltar</router-link> 

                                       
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
														<label class="form-label" for="username">Empresa</label>
														<Field type="text" class="form-control" :class="{'is-invalid':errors.username}" name="username" id="username" placeholder="Empresa"/>
                                                        <span class="invalid-feedback">{{ errors.username }}</span>
													</div>
													
												</div>
                                                <div class="row">
                                                    <div class="mb-3">
													<label class="form-label" for="email">Email</label>
													<Field type="email" class="form-control"  :class="{'is-invalid':errors.email}" name="email" id="email" placeholder="Email"/>
                                                    <span class="invalid-feedback">{{ errors.email }}</span>
												</div>

                                                </div>
												
                                                <div class="row">
                                                    <div class="mb-3">
													<label class="form-label" for="password">Palavra passe</label>
													<Field type="password" class="form-control"  :class="{'is-invalid':errors.password}" name="password" id="password" placeholder="Palavra passe"/>
                                                    <span class="invalid-feedback">{{ errors.password }}</span>
												    </div>
                                                </div>
                                                
												
												
                                              

                                                <div class="mb-3">
                                                    <div class="row">
                                                        <div class="mb-3">
                                                        <label class="form-label" for="companyname">Nome da Empresa</label>
                                                        <Field type="companyname" class="form-control"  :class="{'is-invalid':errors.companyname}" name="companyname" id="companyname" placeholder="Nome da Empresa"/>
                                                        <span class="invalid-feedback">{{ errors.companyname }}</span>
                                                        </div>
                                                        <span class="invalid-feedback">{{ errors.company_name }}</span>
                                                    </div>
													
                                                    <div class="row">
                                                        <div class="mb-3">
                                                        <label class="form-label" for="nuit">NUIT</label>
                                                        <Field type="nuit" class="form-control"  :class="{'is-invalid':errors.nuit}" name="nuit" id="nuit" placeholder="NUIT"/>
                                                        <span class="invalid-feedback">{{ errors.nuit }}</span>
                                                        </div>
                                                        <span class="invalid-feedback">{{ errors.nuit }}</span>
                                                    </div>

                                                    <div class="row">
                                                        <div class="mb-3">
                                                        <label class="form-label" for="address">Endereço</label>
                                                        <Field type="address" class="form-control"  :class="{'is-invalid':errors.address}" name="address" id="address" placeholder="Endereço"/>
                                                        <span class="invalid-feedback">{{ errors.address }}</span>
                                                        </div>
                                                        <span class="invalid-feedback">{{ errors.address }}</span>
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