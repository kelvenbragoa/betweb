<script setup>

import {onMounted, ref, reactive, onUpdated} from 'vue';
import axios from 'axios';
import VueFeather from 'vue-feather';


const loadingDiv = ref(true);
const users = ref(0)
const companies = ref(0)
const stevedors = ref(0)
const transactions = ref(0)
const transactions_pending = ref(0)
const transactions_ongoing = ref(0)
const transctions_expired = ref(0)
const stevedors_with_flag = ref(0)



const getDashboardData = () =>{
    axios.get('/companydashboards')
    .then((response)=>{
        users.value = response.data.users
        companies.value = response.data.companies
        stevedors.value = response.data.stevedors
        transactions.value = response.data.transactions
        transactions_pending.value = response.data.transactions_pending
        transactions_ongoing.value = response.data.transactions_ongoing
        transctions_expired.value = response.data.transctions_expired
        stevedors_with_flag.value = response.data.stevedors_with_flag
        loadingDiv.value=false;
    })
}


onMounted(()=>{

    getDashboardData();

})


onUpdated(()=>{

})



</script>


<template>

    <div v-if="!loadingDiv">
        <h1 class="h3 mb-3">Dashboard Admin</h1>
        
                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-header">
                                        <h5 class="card-title mb-0">Dashboard</h5>
                                    </div>
                                    <div class="card-body">

                                        <div class="row">
                                           
                                            <div class="col-sm-6 col-xl-3">
                                                <div class="card">
                                                    <div class="card-body">
                                                        <div class="row">
                                                            <div class="col mt-0">
                                                                <h5 class="card-title">Estivadores</h5>
                                                            </div>

                                                            <div class="col-auto">
                                                                <div class="stat text-primary">
                                                                    <vue-feather type="square"></vue-feather>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <h1 class="mt-1 mb-3">{{stevedors}}</h1>
                                                        <div class="mb-0">
                                                             <router-link to="/company/stevedors"><vue-feather type="eye"></vue-feather></router-link>
                                                        </div>
                                                        
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-6 col-xl-3">
                                                <div class="card">
                                                    <div class="card-body">
                                                        <div class="row">
                                                            <div class="col mt-0">
                                                                <h5 class="card-title">Estivadores no recinto</h5>
                                                            </div>

                                                            <div class="col-auto">
                                                                <div class="stat text-primary">
                                                                    <vue-feather type="codepen"></vue-feather>
                                                           
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <h1 class="mt-1 mb-3">{{stevedors}}</h1>
                                                        <div class="mb-0">
                                                             <router-link to="/company/stevedors"><vue-feather type="eye"></vue-feather></router-link>
                                                        </div>
                                                        
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-6 col-xl-3">
                                                <div class="card">
                                                    <div class="card-body">
                                                        <div class="row">
                                                            <div class="col mt-0">
                                                                <h5 class="card-title">Transações</h5>
                                                            </div>

                                                            <div class="col-auto">
                                                                <div class="stat text-primary">
                                                                    <vue-feather type="dollar-sign"></vue-feather>
                                                                    
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <h1 class="mt-1 mb-3">{{transactions}}</h1>
                                                        <div class="mb-0">
                                                             <router-link to="/company/transactions"><vue-feather type="eye"></vue-feather></router-link>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-sm-6 col-xl-3">
                                                <div class="card">
                                                    <div class="card-body">
                                                        <div class="row">
                                                            <div class="col mt-0">
                                                                <h5 class="card-title">Transações Pendentes</h5>
                                                            </div>

                                                            <div class="col-auto">
                                                                <div class="stat text-primary">
                                                                    <vue-feather type="list"></vue-feather>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <h1 class="mt-1 mb-3">{{transactions_pending}}</h1>
                                                        <div class="mb-0">
                                                             <router-link to="/company/transactions"><vue-feather type="eye"></vue-feather></router-link>
                                                        </div>
                                                        
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-6 col-xl-3">
                                                <div class="card">
                                                    <div class="card-body">
                                                        <div class="row">
                                                            <div class="col mt-0">
                                                                <h5 class="card-title">Transações em curso</h5>
                                                            </div>

                                                            <div class="col-auto">
                                                                <div class="stat text-primary">
                                                                    <vue-feather type="alert-triangle"></vue-feather>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <h1 class="mt-1 mb-3">{{transactions_ongoing}}</h1>
                                                        <div class="mb-0">
                                                             <router-link to="/company/transactions"><vue-feather type="eye"></vue-feather></router-link>
                                                        </div>
                                                        
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-6 col-xl-3">
                                                <div class="card">
                                                    <div class="card-body">
                                                        <div class="row">
                                                            <div class="col mt-0">
                                                                <h5 class="card-title">Transações Expiradas</h5>
                                                            </div>

                                                            <div class="col-auto">
                                                                <div class="stat text-primary">
                                                                    <vue-feather type="truck"></vue-feather>
                                                           
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <h1 class="mt-1 mb-3">{{transctions_expired}}</h1>
                                                        <div class="mb-0">
                                                             <router-link to="/company/transactions"><vue-feather type="eye"></vue-feather></router-link>
                                                        </div>
                                                        
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