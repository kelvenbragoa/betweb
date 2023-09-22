

//IMPORT ADMIN ROUTES
import Login from './pages/auth/Login.vue';
import DashboardAdmin from './components/DashboardAdmin.vue';
import DashboardCompany from './components/DashboardCompany.vue';

import IndexUsers from './pages/admin/users/IndexUsers.vue';
import CreateUsers from './pages/admin/users/CreateUsers.vue';
import ShowUsers from './pages/admin/users/ShowUsers.vue';
import EditUsers from './pages/admin/users/EditUsers.vue';

import IndexCompanies from './pages/admin/companies/IndexCompanies.vue';
import CreateCompanies from './pages/admin/companies/CreateCompanies.vue';
import ShowCompanies from './pages/admin/companies/ShowCompanies.vue';
import EditCompanies from './pages/admin/companies/EditCompanies.vue';

import IndexStevedors from './pages/admin/stevedors/IndexStevedors.vue';
import CreateStevedors from './pages/admin/stevedors/CreateStevedors.vue';
import ShowStevedors from './pages/admin/stevedors/ShowStevedors.vue';
import EditStevedors from './pages/admin/stevedors/EditStevedors.vue';

import IndexTransactions from './pages/admin/transactions/IndexTransactions.vue';
import CreateTransactions from './pages/admin/transactions/CreateTransactions.vue';
import ShowTransactions from './pages/admin/transactions/ShowTransactions.vue';
import EditTransactions from './pages/admin/transactions/EditTransactions.vue';

import IndexTypeOperations from './pages/admin/typeoperations/IndexTypeOperations.vue';
import CreateTypeOperations from './pages/admin/typeoperations/CreateTypeOperations.vue';
import ShowTypeOperations from './pages/admin/typeoperations/ShowTypeOperations.vue';
import EditTypeOperations from './pages/admin/typeoperations/EditTypeOperations.vue';

//IMPORT COMPANY ROUTES

import IndexCompanyStevedors from './pages/company/stevedors/IndexStevedors.vue';
import CreateCompanyStevedors from './pages/company/stevedors/CreateStevedors.vue';
import ShowCompanyStevedors from './pages/company/stevedors/ShowStevedors.vue';
import EditCompanyStevedors from './pages/company/stevedors/EditStevedors.vue';

import IndexCompanyTransactions from './pages/company/transactions/IndexTransactions.vue';
import CreateCompanyTransactions from './pages/company/transactions/CreateTransactions.vue';
import ShowCompanyTransactions from './pages/company/transactions/ShowTransactions.vue';
import EditCompanyTransactions from './pages/company/transactions/EditTransactions.vue';






export default [

    //auth
    {
        path: '/login',
        name: 'users.login',
        component: Login,
    },

    // ADMIN ROUTES

    
    {
        path: '/admin/dashboard',
        name: 'admin.dashboard',
        component: DashboardAdmin,
    },

    //users
    {
        path: '/admin/users',
        name: 'admin.users.index',
        component: IndexUsers,
    },
    {
        path: '/admin/users/create',
        name: 'admin.users.create',
        component: CreateUsers,
    },
    {
        path: '/admin/users/:id',
        name: 'admin.users.show',
        component: ShowUsers,
    },
    {
        path: '/admin/users/:id/edit',
        name: 'admin.users.edit',
        component: EditUsers,
    },

     //companies
     {
        path: '/admin/companies',
        name: 'admin.companies.index',
        component: IndexCompanies,
    },
    {
        path: '/admin/companies/create',
        name: 'admin.companies.create',
        component: CreateCompanies,
    },
    {
        path: '/admin/companies/:id',
        name: 'admin.companies.show',
        component: ShowCompanies,
    },
    {
        path: '/admin/companies/:id/edit',
        name: 'admin.companies.edit',
        component: EditCompanies,
    },

    //stevedors
    {
        path: '/admin/stevedors',
        name: 'admin.stevedors.index',
        component: IndexStevedors,
    },
    {
        path: '/admin/stevedors/create',
        name: 'admin.stevedors.create',
        component: CreateStevedors,
    },
    {
        path: '/admin/stevedors/:id',
        name: 'admin.stevedors.show',
        component: ShowStevedors,
    },
    {
        path: '/admin/stevedors/:id/edit',
        name: 'admin.stevedors.edit',
        component: EditStevedors,
    },

    //transactions
    {
        path: '/admin/transactions',
        name: 'admin.transactions.index',
        component: IndexTransactions,
    },
    {
        path: '/admin/transactions/create',
        name: 'admin.transactions.create',
        component: CreateTransactions,
    },
    {
        path: '/admin/transactions/:id',
        name: 'admin.transactions.show',
        component: ShowTransactions,
    },
    {
        path: '/admin/transactions/:id/edit',
        name: 'admin.transactions.edit',
        component: EditTransactions,
    },



    //typeoperations
    {
        path: '/admin/typeoperations',
        name: 'admin.typeoperations.index',
        component: IndexTypeOperations,
    },
    {
        path: '/admin/typeoperations/create',
        name: 'admin.typeoperations.create',
        component: CreateTypeOperations,
    },
    {
        path: '/admin/typeoperations/:id',
        name: 'admin.typeoperations.show',
        component: ShowTypeOperations,
    },
    {
        path: '/admin/typeoperations/:id/edit',
        name: 'admin.typeoperations.edit',
        component: EditTypeOperations,
    },



    // ROUTES FOR COMPANY

    {
        path: '/company/dashboard',
        name: 'company.dashboard',
        component: DashboardCompany,
    },

    //stevedors
    {
        path: '/company/stevedors',
        name: 'company.stevedors.index',
        component: IndexCompanyStevedors,
    },
    {
        path: '/company/stevedors/create',
        name: 'company.stevedors.create',
        component: CreateCompanyStevedors,
    },
    {
        path: '/company/stevedors/:id',
        name: 'company.stevedors.show',
        component: ShowCompanyStevedors,
    },
    {
        path: '/company/stevedors/:id/edit',
        name: 'company.stevedors.edit',
        component: EditCompanyStevedors,
    },

    //transactions
    {
        path: '/company/transactions',
        name: 'company.transactions.index',
        component: IndexCompanyTransactions,
    },
    {
        path: '/company/transactions/create',
        name: 'company.transactions.create',
        component: CreateCompanyTransactions,
    },
    {
        path: '/company/transactions/:id',
        name: 'company.transactions.show',
        component: ShowCompanyTransactions,
    },
    {
        path: '/company/transactions/:id/edit',
        name: 'company.transactions.edit',
        component: EditCompanyTransactions,
    },



]

