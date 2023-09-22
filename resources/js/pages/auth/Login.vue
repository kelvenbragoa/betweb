<script setup>

import axios from 'axios';
import {reactive, ref} from 'vue';


const form = reactive ({
        email: '',
        password: ''
});

const loading = ref(false);

const errorMessage = ref('');
    
const handleSubmit = () => {

  loading.value = true;

  errorMessage.value = '';

  axios.post('/login',{

          email: form.email.toLowerCase(),
          password:form.password

  }).then((response)=>{

            console.log(response.data.role_id)
            
            if(response.data.role_id == 1){

              window.location.href="/admin/dashboard";
              

            }

            if(response.data.role_id == 2){

              window.location.href="/company/dashboard";

            }

        })
        .catch((error)=>{

          errorMessage.value = error.response.data.message
          
        })
        .finally(()=>{

          loading.value = false;

        })
    }

</script>


<template>
    <main class="d-flex w-100">
		<div class="container d-flex flex-column">
			<div class="row vh-100">
				<div class="col-sm-10 col-md-8 col-lg-6 mx-auto d-table h-100">
					<div class="d-table-cell align-middle">
						<div class="card">
							<div class="text-center mt-4">
								<h1 class="h2">Bem Vindo de Volta</h1>
								<h1 class="h2">CODELAB</h1>
								<p class="lead">Entre com a sua conta</p>
							</div>
							<div class="card-body">
								<div class="m-sm-4">
									<div class="text-center">
										<img src="/files/img/sys/cdm.jpg" alt="InoGest" class="img-fluid" width="350" height="250" />
									</div>

                  <div v-if="errorMessage" class="alert alert-danger" role="alert">
                      <div class="m-2">
                          {{errorMessage}}
                      </div>
                  </div>
                                  
									<form @submit.prevent="handleSubmit">

                      <div class="mb-3">
                        <label class="form-label">Endereço de email</label>
                        <input class="form-control form-control-lg" type="email" v-model="form.email" placeholder="Introduza o email" required />
                      </div>

                      <div class="mb-3">
                        <label class="form-label">Password</label>
                        <input class="form-control form-control-lg" type="password" v-model="form.password" placeholder="Introduza o password" required/> 
                      </div>
                      
                      <div class="text-center mt-3">
                        
                        <button type="submit" class="btn btn-lg btn-primary" :disabled="loading">
                          <div v-if="loading" class="spinner-border spinner-border-sm" role="status"></div>
                          <span v-else>Entrar</span>
                        </button>
                      </div>

									</form>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</main>
</template>