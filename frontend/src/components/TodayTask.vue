<template>
    <div>

        <div class="main-content">

            <h3 class="title">Tarefas de hoje</h3>

            <div v-for="task in tasks" :key="task.id">
                <div v-if="task.users_id == userId() && task.finishdate == moment().format('YYYY-MM-DD')">

                    <!-- TASKS -->

                    <div class="tasks">

                        <div class="task">

                            <div>
                                <button class="checkbutton" @click="checkTask(task.id)">
                                    <div v-if="task.status == 'pending'">
                                        <img src="../../public/checkvazio.svg" alt="check">
                                    </div>
                                    <div v-else>
                                        <img src="../../public/checkcheio.svg" alt="check">
                                    </div>
                                </button>
                            </div>

                            <!-- MODAL VIEW TASK -->

                            <div class="task-field">

                                <div>

                                    <b-button v-b-modal.modal-sm="'modalviewtask' + task.id" variant="black" body-class="p-0">
                                        <h3 class="title-task">{{ task.title }}</h3>
                                    </b-button>

                                    <b-modal :id="'modalviewtask' + task.id" size="sm" title="Small Modal" body-class="p-0" hide-header hide-footer centered>

                                        <div id="main-container">

                                            <nav class="view-task-nav">

                                                <div v-if="task.finishdate >= moment().format('YYYY-MM-DD')">
                                                    <div class="date-view-green">
                                                        <img src="../../public/dataverde.svg" alt="dataverde"><Label>No prazo</Label>
                                                    </div>
                                                </div>

                                                <div v-else>
                                                    <div class="date-view-red">
                                                        <img src="../../public/datavermelho.svg" alt="datavermelha">
                                                        <Label>Vencido</Label>
                                                    </div>
                                                </div>

                                                <div class="buttons-nav-right">
                                                    <form>
                                                        <div>
                                                            <ul class="main-dropdown">
                                                                <li class="dropdown-hover">
                                                                    <ul class="dropdown">
                                                                        <li class="black-li" @click="copyTask(task.id)"><img src="../../public/copiarlink.svg" alt="copiar link"> Copiar link da tarefa </li>
                                                                        <li class="black-li" @click="duplicateTask(task.id)"><img src="../../public/duplicar.svg" alt="duplicar tarefa"> Duplicar tarefa </li>
                                                                        <li class="black-li" @click="printTask(task.id)"> <img src="../../public/imprimir.svg" alt="imprimir"> Imprimir tarefa </li>
                                                                        <li class="red-li" @click="deleteTask(task.id)"><img src="../../public/lixeiravermelha.svg" alt="excluir"> Excluir tarefa </li>
                                                                    </ul>
                                                                </li>
                                                            </ul>
                                                        </div>

                                                        <div class="buttons-nav-view">
                                                            <button class="x"> <img src="../../public/3pontos.svg" alt="3pontos"></button>
                                                            <button class="x" @click="close()"><img src="../../public/x.svg" alt="x"></button>
                                                        </div>

                                                    </form>
                                                </div>
                                            </nav>

                                            <div class="sub-container">

                                                <div class="left-content">

                                                    <div class="task-view">

                                                        <div>
                                                            <button class="checkbutton" @click="checkTask(task.id)">
                                                                <div v-if="task.status == 'pending'"> <img src="../../public/checkvazio.svg" alt="check"> </div>
                                                                <div v-else> <img src="../../public/checkcheio.svg" alt="check"> </div>
                                                            </button>
                                                        </div>

                                                        <div class="task-field-view">
                                                            <h2 class="title-view">{{ task.title }}</h2>
                                                            <p class="description">{{ task.description }}</p>
                                                        </div>

                                                    </div>

                                                    <h3 class="h3-sub-task">Subtarefas</h3>

                                                    <div class="sub-task-content-view" v-for="subtask in subtasks " :key="subtask.id">

                                                        <div class="sub-task-view" v-if="subtask.task_id == task.id">

                                                            <div>
                                                                <button class="checkbutton" @click="checkSubtask(subtask.id)">
                                                                    <div v-if="subtask.sstatus == 'pending'">
                                                                        <img src="../../public/checkvazio.svg" alt="check">
                                                                    </div>
                                                                    <div v-else>
                                                                        <img src="../../public/checkcheio.svg" alt="check">
                                                                    </div>
                                                                </button>
                                                            </div>

                                                            <div class="sub-task-item">

                                                                <div class="subtask-text-view">
                                                                    <label class="title-sub-task-view">{{ subtask.stitle }} </label>
                                                                    <p class="subtask-description">{{ subtask.sdescription }} </p>
                                                                </div>

                                                                <div class="menu-tasks-view">
                                                                    <b-button v-b-modal.modal-sm="'modalupdatesubtask' + subtask.id" variant="black" body-class="p-0"><img src="../../public/lapis.svg" alt="lapis" class="button-icon-pencil-view"></b-button>
                                                                    <button @click="deleteSubTask(subtask.id)"><img class="item-menu-task2" src="../../public/lixeiracinza.svg" alt="excluir"> </button>
                                                                </div>

                                                            </div>

                                                        </div>

                                                    </div>
                                                </div>

                                                <div class="right-content">

                                                    <h4 class="title-right">Criado em</h4>
                                                    <h5 class="info-black"><img src="../../public/datapreto.svg" alt="calendario-preto">{{ moment(task.created_at).format('DD/MM/YYYY') }} às {{ moment(task.created_at).format('HH:mm') }} </h5>

                                                    <h4 class="title-right">Data de vencimento</h4>
                                                    <div v-if="task.finishdate >= moment().format('YYYY-MM-DD')">
                                                        <h5 class="info-green"><img src="../../public/dataverde.svg" alt="calendario-verde">{{ moment(task.finishdate).format('DD/MM/YYYY') }} </h5>
                                                    </div>

                                                    <div v-else>
                                                        <h5 class="info-red"><img src="../../public/datavermelho.svg" alt="calendario-vermelho">{{ moment(task.finishdate).format('DD/MM/YYYY') }} </h5>
                                                    </div>

                                                    <h4 class="title-right">Modificado em</h4>
                                                    <h5 class="info-black"><img src="../../public/datapreto.svg" alt="calendario-preto"> {{ moment(task.updated_at).format('DD/MM/YYYY') }} às {{ moment(task.updated_at).format('HH:mm') }} </h5>

                                                    <h4 class="title-right">ID da tarefa</h4>
                                                    <h5 class="info-black">{{ task.id }}</h5>

                                                </div>

                                            </div>

                                        </div>
                                    </b-modal>
                                </div>

                                <!-- MODAL VIEW TASK - END -->

                                <p class="description">{{ task.description }}</p>
                                <div class="date-counter">

                                    <div v-if="task.finishdate >= moment().format('YYYY-MM-DD')">
                                        <div class="green-date">
                                            <img src="../../public/dataverde.svg" alt="">{{ moment(task.finishdate).format('DD/MM/YYYY') }}
                                        </div>
                                    </div>

                                    <div v-else>
                                        <div class="red-date">
                                            <img src="../../public/datavermelho.svg" alt=""> {{ moment(task.finishdate).format('DD/MM/YYYY') }}
                                        </div>
                                    </div>

                                    <div class="counter">
                                        {{ subtasks.filter(sub => sub.task_id == task.id && sub.sstatus == "completed").length }}/{{  subtasks.filter(sub => sub.task_id == task.id).length }}
                                    </div>
                                </div>

                            </div>

                            <!-- MODAL UPDATE TASK -->

                            <div class="menu-tasks">

                                <div>

                                    <b-button v-b-modal.modal-sm="'modalupdatetask' + task.id" variant="black" body-class="p-0"><img src="../../public/lapis.svg" alt="lapis"></b-button>

                                    <b-modal :id="'modalupdatetask' + task.id" size="sm" title="Small Modal" body-class="p-0" hide-header hide-footer centered>

                                        <form id="form">

                                            <div>
                                                <input type="name" id="task-name" name="task-name" placeholder="Nome da tarefa" maxlength="30" v-model="title">
                                            </div>

                                            <div>
                                                <input type="name" id="task-description" name="task-description" maxlength="50" placeholder="Descrição" v-model="description">
                                            </div>

                                            <div class="buttons">
                                                <button class="white-button" @click="close()">Cancelar</button>
                                                <div class="button" @click="updateTask(task.id)">
                                                    <input type="button" class="black-button" value="Atualizar tarefa">
                                                </div>
                                            </div>

                                        </form>

                                    </b-modal>
                                </div>

                                <!-- MODAL UPDATE TASK DATE -->

                                <div>

                                    <b-button v-b-modal.modal-sm="'modalupdatetaskdate' + task.id" variant="black" body-class="p-0"><img src="../../public/calendario.svg" alt="calendario" class="button-icon-date"></b-button>

                                    <b-modal :id="'modalupdatetaskdate' + task.id" size="sm" title="Small Modal" body-class="p-0" hide-header hide-footer centered>

                                        <form id="form-date">

                                            <div class="button-date">
                                                <img src="../../public/calendario.svg" alt="">
                                                <input placeholder="Data de vencimento" class="date" type="text" onfocus="(this.type='date')" onblur="(this.type='text')" id="date" v-model="finishdate">
                                            </div>

                                            <div class="buttons-date">
                                                <button class="white-button" @click="close()">Cancelar</button>
                                                <div class="button" @click="updateDate(task.id)">
                                                    <input type="button" class="black-button" value="Atualizar data">
                                                </div>
                                            </div>

                                        </form>

                                    </b-modal>

                                </div>

                                <button @click="deleteTask(task.id)" class="trash-button"><img src="../../public/lixeiracinza.svg" alt="excluir"></button>

                            </div>

                        </div>

                        <!-- SUBTASK -->

                        <div class="main-subtask-content">

                            <div v-for="subtask in subtasks.filter(sub => sub.task_id == task.id)" :key="subtask.id">

                                <div class="sub-task-content">

                                    <div class="sub-task">

                                        <div>
                                            <button class="checkbutton" @click="checkSubtask(subtask.id)">

                                                <div v-if="subtask.sstatus == 'pending'">
                                                    <img src="../../public/checkvazio.svg" alt="check">
                                                </div>

                                                <div v-else>
                                                    <img src="../../public/checkcheio.svg" alt="check">
                                                </div>

                                            </button>
                                        </div>

                                        <!-- COLLAPSE SUBTASK -->

                                        <div class="subtask-text">
                                            
                                            <b-button v-b-toggle="`collapse-2-${subtask.id}`"   class="m-0" style="padding: 0; background-color: transparent; border: none; height: 20px;"><label class="title-subtask">{{ subtask.stitle }}</label></b-button>

                                            <b-collapse :id="`collapse-2-${subtask.id}`" style="padding-top: 7px; ">
                                                <b-card style="padding: 0; background-color: transparent; border: none; height: 20px;">
                                                    <p class="description-subtask">{{ subtask.sdescription }}</p>
                                                </b-card>
                                            </b-collapse>

                                        </div>

                                    </div>

                                    <!-- MODAL UPDATE SUBTASK -->

                                    <div class="menu-subtasks">

                                        <div>

                                            <b-button v-b-modal.modal-sm="'modalupdatesubtask' + subtask.id" variant="black" body-class="p-0"><img src="../../public/lapis.svg" alt="lapis" class="button-icon-date"></b-button>

                                            <b-modal :id="'modalupdatesubtask' + subtask.id" size="sm" title="Small Modal" body-class="p-0" hide-header hide-footer centered>

                                                <form id="form">

                                                    <div>
                                                        <input type="name" id="task-name" name="task-name" placeholder="Nome da tarefa" maxlength="35" v-model="stitle">
                                                    </div>

                                                    <div>
                                                        <input type="name" id="task-description" name="task-description" maxlength="50" placeholder="Descrição" v-model="sdescription">
                                                    </div>

                                                    <div class="buttons">
                                                        <button class="white-button" @click="close()">Cancelar</button>
                                                        <div class="button" @click="updateSubTask(subtask.id)"> <input type="button" class="black-button-new-subtask" value="Atualizar subtarefa"> </div>
                                                    </div>

                                                </form>

                                            </b-modal>

                                        </div>

                                        <button> <img src="../../public/lixeiracinza.svg" alt="excluir" @click="deleteSubTask(subtask.id)"></button>
                                    </div>

                                </div>

                            </div>

                        </div>

                    </div>

                    <div class="add-task">

                        <!-- CREATE NEW SUBTASK -->

                        <div>

                            <b-button v-b-modal.modal-sm="'modalnewsubtask' + task.id" variant="black" class="subtask-text" body-class="p-0"><img src="../../public/adicionarcinza.svg" alt="adicionar">Criar subtarefa</b-button>

                            <b-modal :id="'modalnewsubtask' + task.id" size="sm" style="width:400px" title="Small Modal" body-class="p-0" hide-header hide-footer centered>

                                <form id="form">

                                    <div>
                                        <input type="name" id="task-name" name="task-name" placeholder="Nome da subtarefa" maxlength="30" v-model="stitle">
                                    </div>

                                    <div>
                                        <input type="name" id="task-description" name="task-description" maxlength="50" placeholder="Descrição" v-model="sdescription">
                                    </div>

                                    <div class="buttons">
                                        <button class="white-button" @click="close()">Cancelar</button>
                                        <div class="button" @click="createNewSubTask(task.id)">
                                            <input type="button" class="black-button" value="Criar subtarefa">
                                        </div>
                                    </div>

                                </form>
                            </b-modal>
                        </div>

                    </div>

                </div>

            </div>

        </div>

        <footer class="footer-items">
            <h6>Fernando Códolo Pagani &copy 2024 </h6>
            <div class="icons-footer">
                <a href="https://www.linkedin.com/in/fernandocpagani/" target="_blank"><img src="../../public/linkedin.svg" alt="icone linkedin"></a>
                <a href="https://www.instagram.com/fernandocpagani/" target="_blank"><img src="../../public/instagram.svg" alt="icone instagram"></a>
                <a href="https://www.facebook.com/fernando.codolopagani/" target="_blank"><img src="../../public/facebook.svg" alt="icone facebook"></a>
                <a href="https://github.com/fernandocpagani" target="_blank"><img src="../../public/github.svg" alt="icone gihub"></a>
            </div>
        </footer>

    </div>
</template>

<script>

import moment from 'moment'
import axios from 'axios'

export default {
    name: "Entrance",

    data() {
        return {
            tasks: [],
            subtask: null,
            subtasks: [],
            stitle: null,
            id: null,
            title: null,
            description: null,
            date: null,
            status: null,
            sstatus: null,
        }
    },

    methods: {

        async duplicateTask(id) {

            const user = JSON.parse(localStorage.getItem("user-info"))
            const resulttask = axios.get(`http://localhost:8000/api/task/${id}`)
                .then(function (resulttask) {
                    const data = {
                        title: resulttask.data.title,
                        description: resulttask.data.description,
                        finishdate: resulttask.data.finishdate,
                        users_id: user.user.id,
                    }

                    const result = axios.post('http://localhost:8000/api/task/register', data)
                        .then(function (response) {
                            const taskid = response.data.id

                            const resultsub = axios.get(`http://localhost:8000/api/subtask/taskid/${id}`)
                                .then(function (responsesub) {

                                    for (let i = 0; i < responsesub.data.length; i++) {

                                        const datasub = {
                                            stitle: responsesub.data[i].stitle,
                                            sdescription: responsesub.data[i].sdescription,
                                            task_id: taskid,
                                        }

                                        const resultsubsend = axios.post('http://localhost:8000/api/subtask/register', datasub)
                                            .then(function (response) {
                                                console.log(response);
                                            })

                                        }                                       
                                })
                        })
                        .catch(function (error) {
                            console.error(error);
                        });
                })            
        },

        userId() {
            let userId = JSON.parse(localStorage.getItem('user-info')).user.id;
            return userId
        },

        async printTask(id) {         
            window.open(`http://localhost:8080/modalviewtask/${id}`)
                .then(() => { window.print() });
        },

        async copyTask(id) {           
            await navigator.clipboard.writeText(`http://localhost:8080/modalviewtask/${id}`);
        },

        async checkTask(id) {
            const result = await axios.get(`http://localhost:8000/api/task/${id}`)
            if (result.data.status == "pending") {
                const result = await axios.put(`http://localhost:8000/api/task/${id}/updatetaskstatus`,
                    {
                        status: "completed"

                    })
            } else {
                const result = await axios.put(`http://localhost:8000/api/task/${id}/updatetaskstatus`,
                    {
                        status: "pending"
                    })
            }           
            if (result.status == 200) {
                window.location = window.location;               
            }
        },

        async checkSubtask(id) {
            const result = await axios.get(`http://localhost:8000/api/subtask/${id}`)
            if (result.data.sstatus == "pending") {
                const result = await axios.put(`http://localhost:8000/api/subtask/${id}/updatesubtaskstatus`,
                    {
                        sstatus: "completed"

                    })
            } else {
                const result = await axios.put(`http://localhost:8000/api/subtask/${id}/updatesubtaskstatus`,
                    {
                        sstatus: "pending"
                    })
            }
            if (result.status == 200) {
                window.location = window.location;               
            }
        },

        async updateDate(id) {
            const result = await axios.put(`http://localhost:8000/api/task/${id}/updatedate`,
                {
                    finishdate: this.finishdate,
                });
            if (result.status == 200) {
                window.location = window.location;              
            }
        },

        async updateSubTask(id) {
            const result = await axios.put(`http://localhost:8000/api/subtask/${id}/update`,
                {
                    stitle: this.stitle,
                    sdescription: this.sdescription,
                });
            if (result.status == 200) {
                window.location = window.location;                
            }
        },

        async updateTask(id) {
            const result = await axios.put(`http://localhost:8000/api/task/${id}/update`,
                {
                    title: this.title,
                    description: this.description,
                });
            if (result.status == 200) {
                window.location = window.location;             
            }
        },

        async deleteTask(id) {
            axios.delete(`http://localhost:8000/api/task/${id}/delete`)
                .then(() => {
                    window.location = window.location;                 
                })
        },

        async deleteSubTask(id) {
            axios.delete(`http://localhost:8000/api/subtask/${id}/delete`)
                .then(() => {
                    window.location = window.location;                   
                })
        },

        async createNewSubTask(id) {
            const data = {
                stitle: this.stitle,
                sdescription: this.sdescription,
                task_id: id,
            }
          
            axios.post('http://localhost:8000/api/subtask/register', data)
                .then(function (response) {
                    console.log(response);
                    window.location = window.location;                    
                })
                .catch(function (error) {
                    console.error(error);
                });
        },
    },

    async mounted() {
        {
            const result = await axios.get(`http://localhost:8000/api/subtask/` + this.$route.params.id)
            this.stitle = result.data.stitle
            this.sdescription = result.data.sdescription
        }
        {
            axios
                .get('http://127.0.0.1:8000/api/task')
                .then((response) => {
                    this.tasks = response.data
                    this.moment = moment;
                })
        }
        {
            axios
                .get('http://localhost:8000/api/subtask')
                .then((response) => {
                    this.subtasks = response.data
                    this.moment = moment;
                })
        }
        {
            const result = await axios.get(`http://localhost:8000/api/task/` + this.$route.params.id)
            this.title = result.data.title
            this.description = result.data.description
            this.date = result.data.finishdate
        }
    },
}

</script>

<style scoped>
.main-content {
    box-sizing: border-box;
    padding: 50px 144px 50px 165px;
    background-color: #ffffff;
    margin-top: 70px;
    margin-left: 293px;
}

.title {
    font-size: 24px;
    font-weight: 800;
    line-height: 29px;
    margin-bottom: 30px;
}

.task {
    width: 678px;
    border: solid 1px #e5e5e5;
    box-sizing: border-box;
    padding: 15px 25px;
    display: flex;
    flex-direction: row;
    transition: .5;
}

.checkbutton {
    border: none;
    background-color: transparent;
}

.task-field {
    width: 475px;
    margin-left: 20px;
}

.title-task {
    font-size: 18px;
    font-weight: 400;
    line-height: normal;
    color: #000;
    text-decoration: none;
}

.card-body {
    padding: 0;
}
.description-subtask {
    font-size: 14px;
    font-weight: 400;
    line-height: 17px;
    color: #81858e;
    padding-bottom: 0px;
    width: 200px;
    margin-bottom: 0px;
}

.menu-subtasks button {
    border: none;
    background-color: transparent;
    display: none;
}

.sub-task-content:hover .menu-subtasks button {
    display: block;
}

.menu-subtasks {
    display: flex;
    align-items: center;
}

.subtask-text-view {
    margin-left: 20px;
    width: 335px;
}

.subtask-description {
    font-size: 14px;
    font-weight: 400;
    line-height: 17px;
    color: #81858e;
    padding-top: 7px;
    width: 200px;
}

.red-date {
    font-size: 14px;
    color: #d31408;
    background-color: #d314081a;
    padding: 4px 7px;
    width: 125px;
}

.red-date img {
    margin-right: 10px;
}

.green-date {
    font-size: 14px;
    color: #009488;
    background-color: #e5f4f3;
    padding: 4px 7px;
    width: 125px;
}

.green-date img {
    margin-right: 10px;
}

.description {
    font-size: 14px;
    font-weight: 400;
    line-height: 17px;
    letter-spacing: 0em;
    text-align: left;
    margin-bottom: 10px;
}

.date-counter {
    display: flex;
    flex-direction: row;
}

.view-task-nav {
    padding: 7px 30px;
}

.date-view-green {
    padding: 4px 8px;
    width: 110px;
    background-color: #e5f4f3;
    font-size: 14px;
    font-weight: 500;
    line-height: 17px;
    text-align: left;
    color: #009488
}

.date-view-green img {
    width: 13px;
    height: 14.44px;
    margin-right: 10px;
}

.date-view-red {
    padding: 4px 8px;
    width: 110px;
    background-color: #d314081a;
    font-size: 14px;
    font-weight: 500;
    line-height: 17px;
    text-align: left;
    color: #d31408;
}

.date-view-red img {
    width: 13px;
    height: 14.44px;
    margin-right: 10px;
}

.counter {
    font-size: 14px;
    font-weight: 400;
    color: #81858e;
    padding: 4px 10px;
}

.menu-tasks {
    display: flex;
    align-items: center;
}

.menu-tasks button {
    border: none;
    display: none;
    background-color: transparent;
    cursor: pointer;
}

.task:hover .menu-tasks button {
    display: block;
}

/*MODAL VIEW TASK*/

#main-container {
    width: 819px;
    min-height: 613px;
    background-color: #fff;
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
}

nav {
    display: flex;
    flex-direction: row;
    justify-content: space-between;
    padding: 20px 30px;
    border-bottom: solid 1px #d9d9d9;
    align-items: center;
}


.buttons-nav-right {
    align-items: center;
}

.main-dropdown {
    list-style: none;
}

.dropdown-hover {
    position: absolute;
    display: none;
    margin-top: 25px;
    right: 0px;
}

.dropdown {
    list-style: none;
    padding: 29px;
    width: 246px;
    height: 232px;
    position: relative;
    background-color: #fff;
}

form:hover .dropdown-hover {
    display: block;
}

.black-li {
    justify-items: center;
    text-decoration: none;
    margin-bottom: 30px;
    font-size: 14px;
    font-weight: 400;
    line-height: 17px;
    text-align: left;
    cursor: pointer;
}

.black-li img {
    margin-right: 20px;
    width: 17px;
    height: 17px;
}

.red-li {
    text-decoration: none;
    color: #d31408;
    margin-bottom: 30px;
    font-size: 14px;
    font-weight: 400;
    line-height: 17px;
    text-align: left;
    cursor: pointer;
}

.red-li img {
    margin-right: 20px;
    width: 17px;
    height: 17px;
}

.buttons-nav-view {
    margin-bottom: 12px;
}

.x {
    margin-left: 35px;
    background-color: transparent;
    border: none;
    cursor: pointer;
}

.sub-container {
    display: flex;
    flex-direction: row;
}

.left-content {
    width: 573px;
}

.task-view {
    width: 513px;
    box-sizing: border-box;
    padding: 30px 30px 0px 30px;
    display: flex;
    flex-direction: row;
    transition: .5;
}

.task-field-view {
    width: 447px;
    padding-left: 20px;
}

.title-view {
    font-size: 18px;
    font-weight: 600;
    line-height: normal;
    color: #000;
    max-width: 470px;
}

.h3-sub-task {
    font-size: 14px;
    font-weight: 600;
    line-height: 17px;
    letter-spacing: 0em;
    border-bottom: solid 1px #e5e5e5;
    color: #000;
    margin-left: 70px;
    margin-top: 38px;
    width: 470px;
    padding-bottom: 15px;
}

.sub-task-content-view {
    box-sizing: border-box;
    border-top: none;
    margin: 10px 0px;
}

.sub-task-view {
    display: flex;
    flex-direction: row;
    box-sizing: border-box;
    padding: 10px 0;
    margin-left: 70px;
    width: 470px;
}

.sub-task-item {
    display: flex;
    flex-direction: row;
}

.menu-tasks-view {
    display: flex;
    align-items: center;
    display: none;
    margin: auto 0;
}

.item-menu-task2 {
    padding: 0 0 0 30px;
    border: none;
    background-color: transparent;
    cursor: pointer;
}

.menu-tasks-view button {
    border: none;
    background-color: transparent;
    cursor: pointer;
}

.sub-task-item:hover .menu-tasks-view {
    display: block;
}

.right-content {
    box-sizing: border-box;
    background-color: #f7f7f7;
    padding: 30px;
    width: 246px;
    min-height: 546px;
}

.title-right {
    font-size: 14px;
    font-weight: 400;
    line-height: 17px;
    text-align: left;
    margin-bottom: 10px;
    color: #81858e;
}

.info-black {
    font-size: 14px;
    font-weight: 600;
    line-height: 17px;
    text-align: left;
    margin-bottom: 40px;
    color: #000;
}

.info-green {
    font-size: 14px;
    font-weight: 600;
    line-height: 17px;
    text-align: left;
    margin-bottom: 40px;
    color: #009488;
}

.info-red {
    font-size: 14px;
    font-weight: 600;
    line-height: 17px;
    text-align: left;
    margin-bottom: 40px;
    color: #d31408;
}

.info-black img, .info-green img, .info-red img {
    margin-right: 10px;
}

/* MODAL UPDATE TASK */

.btn, .btn-black {
    border: none;
    color: #81858e;
    font-size: 15px;
    padding: 0;
}

#form {
    width: 678px;
    height: 216px;
    background-color: #fff;
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
}

#form-date {
    width: 678px;
    height: 216px;
    padding-top: 93px;
    background-color: #fff;
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
}
.button-date {
    margin-left: 25px;
    width: 200px;
    height: 40px;
    box-sizing: border-box;
    border: solid 1px #e5e5e5;
    background-color: #fff;
    margin-bottom: 15px;
    font-size: 14px;
}

#task-name {
    font-size: 16px;
    font-weight: 400;
    line-height: 20px;
    margin-top: 21px;
    margin-left: 25px;
    border: none;
}

#task-description {
    font-size: 14px;
    font-weight: 400;
    line-height: 17px;
    margin-top: 15px;
    margin-left: 25px;
    margin-bottom: 20px;
    border: none;
}

.button-date {
    margin-left: 25px;
    width: 199px;
    height: 40px;
    box-sizing: border-box;
    border: solid 1px #e5e5e5;
    background-color: #fff;
    margin-bottom: 15px;
    display: flex;
    flex-direction: row;
}

.button-date img {
    height: 14px;
    width: 14px;
    margin: 13px 14px 10px 13px;
}

.date {
    border: none;
    font-size: 14px;
}

.buttons {
    display: flex;
    flex-direction: row;
    justify-content: space-between;
    margin-top: 55px;
    border-top: solid 1px #e5e5e5;
    padding: 14px 25px;
}

.buttons-date {
    display: flex;
    flex-direction: row;
    justify-content: space-between;
    margin-top: 15px;
    border-top: solid 1px #e5e5e5;
    padding: 14px 25px;
}

.white-button {
    width: 122px;
    height: 40px;
    border: none;
    background-color: #f7f7f7;
    color: #000;
    font-size: 14px;
    font-style: normal;
    font-weight: 600;
    line-height: 17.07px;
    cursor: pointer;
    text-align: center;
    padding: 12px 0;
    margin-left: 380px;
}

.black-button {
    width: 122px;
    height: 40px;
    background-color: #000;
    color: #fff;
    font-size: 14px;
    font-style: normal;
    font-weight: 600;
    line-height: 17.07px;
    cursor: pointer;
    margin-left: 15px;
}

.trash-button {
    padding: 0;
    background-color: transparent;
    border: none;
}

.button-icon-date {
    padding: 0 30px;
}

.btn, .btn-secondary {
    background-color: transparent;
}

.btn:hover,
.btn-secondary:hover {
    background-color: transparent;
}

/* MODAL SUB TASK */

.main-subtask-content:hover {
    background-color: #fafafa;
}

.sub-task-content {
    box-sizing: border-box;
    border-left: solid 1px #e5e5e5;
    border-right: solid 1px #e5e5e5;
    border-top: none;
    padding-left: 65px;
    padding-right: 25px;
    display: flex;
    flex-direction: row;

}

.sub-task {
    display: flex;
    flex-direction: row;
    box-sizing: border-box;
    padding: 10px 0;
    align-items: center;
    align-content: center;
}

.black-button-new-subtask {
    width: 150px;
    height: 40px;
    background-color: #000;
    color: #fff;
    font-size: 14px;
    font-style: normal;
    font-weight: 600;
    line-height: 17.07px;
    cursor: pointer;
    margin-left: 15px;
}

.add-task {
    padding: 15px 5px;
    box-sizing: border-box;
    border: solid 1px #e5e5e5;
    color: #81858e;
    font-size: 15px;
    margin-bottom: 20px;
}

.add-task:hover {
    background-color: #fafafa;
}

.task:hover {
    background-color: #fafafa;
}

.subtask-text {
    font-size: 15px;
    font-weight: 400;
    line-height: 18px;
    letter-spacing: 0em;
    text-align: left;
    text-decoration: none;
    color: #81858E;
    width: 450px;
    margin-left: 20px
}

.subtask-text img {
    margin-right: 10px;
}

.btn:hover, .btn-secondary:hover {
    background-color: transparent;
    color: #81858E;
}

.footer-items {
    display: none;
}

@media(max-width: 490px) {

    .sub-task {
        width: 269px;
    }

    .sub-task-text {
        width: 200px;
    }

    .sub-task-content {
        width: 469px;
    }

    #form, #form-date {
        width: 480px;
        margin: auto 0;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
    }

    #form-date {
        max-width: 470px;
    }

    .white-button {
        margin-left: 150px;
    }

    .main-content {
        margin-left: 0;
        padding: 50px 0 0 0;
        margin: 140px 10px 10px 10px;
        max-width: 469px;
    }

    .task {
        max-width: 469px;
    }

    .footer-items {
        display: flex;
        flex-direction: row;
        text-align: center;
        position: fixed;
        bottom: 0;
        justify-items: center;
        width: 100%;
        background-color: #fafafa;
        justify-content: space-between;
        padding: 10px 30px 0 30px;
        height: 40px;
        margin: auto 0;
    }

    .icons-footer img {
        margin-left: 10px;
        margin-bottom: 8px;
        cursor: pointer;        
    }

    .add-task {
        margin-bottom: 50px;
    }

    /* MODAL VIEW TASK */

    #main-container {
        width: 460px;
        top: 0;
        left: 50%;
        transform: translate(-50%, -30%);
    }

    .right-content {
        width: 460px;
        min-height: 360px;
    }

    .left-content {
        width: 460px;
    }

    .h3-sub-task {
        width: 390px;
    }

    .sub-task-item {
        width: 370px;
    }

    .task-view {
        width: 429px;
    }

    .right-content h4, .right-content h5 {
        text-align: center;
    }

    .button-icon-pencil-view {
        padding: 0 30px 0 0
    }

    .menu-tasks-view {
        width: 100px
    }

    .sub-container {
        flex-direction: column;
    }
}

</style>