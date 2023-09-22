<script setup>

import {onMounted, ref, reactive,watch} from 'vue';
import axios from 'axios';
import {useToastr} from '../../../toastr';
import {Form, Field,FieldArray} from 'vee-validate';
import * as yup from 'yup';
import { useRouter } from "vue-router";
import moment from 'moment'
import {debounce} from 'lodash';
import { Bootstrap4Pagination } from 'laravel-vue-pagination';
import VueFeather from 'vue-feather';

const loading = ref(false);
const toastr = useToastr();
let typeoperations =ref([]);
let stevedors =ref([]);
let currentvalue = ref([]);
const loadingDiv = ref(true);
const user_role = ref(0);

const schema = yup.object({
    
  start_date: yup.string().required(),
  end_date: yup.string().required(),
  type_operation_id: yup.string().required(),
//   stevedors: yup.array().of(
//     yup.object().shape({
//         stevedor_id: yup.string().required(),
        
//       })
//   ),
  

});
let self = this;
const router = useRouter();

const createRecordFunction = (values, actions) => {

    currentvalue.value = {values};
    loading.value = true;
    const arr = Array.from(values)
    axios.post('/company-transactions',values).then((response)=>{

    actions.resetForm();
    router.push({ path: '/company/transactions' });
    toastr.success('Transação criado com sucesso');

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

  axios.get('/auxiliar-create-transactions')
       .then((response)=>{

        stevedors.value = response.data.stevedors;
        typeoperations.value = response.data.typeoperations;
        loadingDiv.value=false;

       })
       .catch((error)=>{
        toastr.error(error);
        router.push({ path: '/company/transactions' });
       })
}



onMounted(()=>{
    getAuxiliarData()
})
</script>

<template>
    <div v-if="!loadingDiv">
        <h1 class="h3 mb-3">Transaçãos</h1>
        
                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-header">
                                        <h5 class="card-title">Formulário criação dos Transaçãos do sistema.</h5>

                                        <router-link to="/company/transactions" class="btn btn-pill btn-primary mt-3"><vue-feather type="arrow-left"></vue-feather>Voltar</router-link> 

                                       
								    </div>
                                    
                                    <div class="card-body">
                                            <Form @submit="createRecordFunction" :validation-schema="schema" v-slot="{ errors }">
												<div class="row">
													<div class="mb-3 col-md-12">
														<label class="form-label" for="start_date">Data de Inicio</label>
														<Field type="date" class="form-control" :class="{'is-invalid':errors.start_date}" name="start_date" id="start_date" placeholder="Data de Inicio"/>
                                                        <span class="invalid-feedback">{{ errors.start_date }}</span>
													</div>
													
												</div>
                                                <div class="row">
													<div class="mb-3 col-md-12">
														<label class="form-label" for="end_date">Data de Fim</label>
														<Field type="date" class="form-control" :class="{'is-invalid':errors.end_date}" name="end_date" id="end_date" placeholder="Data de Fim"/>
                                                        <span class="invalid-feedback">{{ errors.end_date }}</span>
													</div>
													
												</div>
                                              

                                                <div class="row">
													
													<div class="mb-3 col-md-12">
														<label class="form-label" for="type_operation_id">Tipo de Operação</label>
														<Field as="select" class="form-control" :class="{'is-invalid':errors.type_operation_id}"  name="type_operation_id" id="type_operation_id" aria-describedby="type_operation_id">
                                                            <option value="" disabled>Selecionar</option>
                                                            <option v-for="typeoperation in typeoperations" :key="typeoperation.id" :value="typeoperation.id">{{ typeoperation.name }}</option>
                                                        </Field>
                                                        <span class="invalid-feedback">{{ errors.type_operation_id }}</span>
													</div>
												</div>
                                              
                                                <hr>

                                                <p>Por favor selecione a lista dos estivadores para esta transação</p>
                                    

                                                

                                                <FieldArray class="form-control" name="stevedors">
                                                    <fieldset class="InputGroup" v-for="(stevedor , idx) in stevedors" :key="stevedor.id">
                                                        <div class="mb-3 col-md-12">
                                                            <label class="form-check">
                                                                <!-- <Field as="checkbox" class="form-check-input"  :name="`stevedors[${idx}].stevedor_id`" v-model="stevedor.id" /> -->
                                                                <Field type="checkbox" class="form-check-input"  :name="`stevedors[${idx}].stevedor_id`" :value=stevedor.id />
                                                                <span class="form-check-label">
                                                                #{{idx+1}} - <strong>Nome:</strong>{{stevedor.name}} | <strong>Contacto:</strong>{{stevedor.contact}} | <strong>Documento:</strong> {{stevedor.document}}
                                                                </span>
                                                            </label>
                                                        </div>
                                                    </fieldset>
                                                </FieldArray>

                                                
                                                
												
												
                                              



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