const axios = require('axios')
const config = require('./config.json')

axios.defaults.baseURL = config.url

const userInfo = config.admin

async function executeTests() {
  // Login to system
  const response = await axios.post('/user', {...userInfo})

  const token = response.data.data.token

  axios.defaults.headers['Authorization'] = `Bearer ${token}`

  // Get users
  const pageInfo = (await axios.get('/users')).data.data.users
  console.log(`There are ${pageInfo.total} users`)

  const userId = pageInfo.data[1].id
  const user = (await axios.get(`/users/${userId}`)).data.data.user
  console.log(`User (#${user.id}) - ${user.name}, ${user.email}`)

  // Get projects of user
  const projects = (await axios.get(`/users/${user.id}/projects`)).data.data.projects
  console.log('Projects of the user:', projects.map((p) => p.name).join(', '))

  // Update the user info
  const newName = `New Name ${Math.random()}`
  console.log(`Updating user name to ${newName}`)
  await axios.put(`/users/${user.id}`, {name: newName})
  console.log('User has been updated')
}

executeTests().then(() => {
  console.log('It finished well')
})
