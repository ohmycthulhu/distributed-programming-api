const axios = require('axios')
const config = require('./config.json')

axios.defaults.baseURL = config.url

const userInfo = config.user

async function executeTests() {
  // Login to system
  const response = await axios.post('/user', {...userInfo})

  const token = response.data.data.token

  axios.defaults.headers['Authorization'] = `Bearer ${token}`

  // Get projects
  const projects = (await axios.get('/projects')).data.data.projects.data

  const project = projects[0]

  console.log('Got the project - ', project.name)

  // Get the project info
  const projectData = (await axios.get(`/projects/${project.id}`)).data.data.project

  console.log('Got the project info:', projectData.description)

  console.log('With the tags:', projectData.tags.map((p) => p.name).join(', '))
}

executeTests().then(() => {
  console.log('It finished well')
})
