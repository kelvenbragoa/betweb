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
    username: yup.string().required(),
    email: yup.string().email().required(), 
  });







const getData = () => {
  axios.get(`/users/+${router.currentRoute.value.params.id}/edit`)
       .then((response)=>{

       
        retrievedData.value = response.data.user;
        roles.value = response.data.roles;
        areas.value = response.data.areas;
        provinces.value = response.data.provinces;
        user_statuses.value = response.data.user_statuses;
        account_statuses.value = response.data.account_statuses;
        cities.value = response.data.cities;

        loadingDiv.value=false;

       }).catch(()=>{

        loadingDiv.value=false;

       })
}

const editFunction = (values, actions) => {

  loadingButtonSubmit.value = true;
  axios.patch(`/users/${retrievedData.value.id}`,values).then((response)=>{

    // admins.value.unshift(response.data);
    // $('#createCategory').modal('hide');
    actions.resetForm();
    router.push({ path: '/admin/users' });
    toastr.success('Usuário editada com sucesso');

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

const getCity = (city) => {

axios.get(`/auxiliar-create-users/${city}`)
   .then((response)=>{

    cities.value = response.data.cities;
   })
   .catch((error)=>{
    toastr.error(error);
    router.push({ path: '/admin/users' });
   })


}



onMounted(()=>{
  
  getData();

})
</script>

<template>
    <div v-if="!loadingDiv">

        <h1 class="h3 mb-3">Usuário </h1>
        
                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-header">
                                        <h5 class="card-title">Usuário: {{ retrievedData.name }}</h5>

                                        <router-link to="/admin/users" class="btn btn-pill btn-primary mt-3"><vue-feather type="arrow-left"></vue-feather>Voltar</router-link> 

                                       
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
                                                                <label class="form-label" for="username">Usuário</label>
                                                                <Field type="text" class="form-control" :class="{'is-invalid':errors.username}" v-model="retrievedData.username" name="username" id="username" placeholder="Usuário"/>
                                                                <span class="invalid-feedback">{{ errors.username }}</span>
                                                            </div>
                                                           
                                                        </div>

                                                        <div class="mb-3">
                                                            <label class="form-label" for="email">Email</label>
                                                            <Field type="email" class="form-control"  :class="{'is-invalid':errors.email}" v-model="retrievedData.email" name="email" id="email" placeholder="Email"/>
                                                            <span class="invalid-feedback">{{ errors.email }}</span>
                                                        </div>
                                                        <div class="mb-3">
                                                            <label class="form-label" for="password">Palavra passe</label>
                                                            <Field type="password" class="form-control"  :class="{'is-invalid':errors.password}" name="password" id="password" placeholder="Palavra passe"/>
                                                            <span class="invalid-feedback">{{ errors.password }}</span>
                                                        </div>
                                                       
                                                     
                                                       
                                                        <div class="row">
                                                            <div class="mb-3">
                                                            <label class="form-label" for="role_id">Nivel</label>
                                                            <Field type="role_id" class="form-control"  :class="{'is-invalid':errors.role_id}" v-model="retrievedData.role.name" name="role_id" id="role_id" placeholder="Nível" readonly/>
                                                            <span class="invalid-feedback">{{ errors.role_id }}</span>
                                                            </div>
                                                            <span class="invalid-feedback">{{ errors.role_id }}</span>
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