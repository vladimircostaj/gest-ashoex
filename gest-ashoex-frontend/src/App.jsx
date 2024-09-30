import { useState } from 'react'
import HealthCheck from './components/health/health.jsx'
import './App.css'
import RegistrarPersonalPage from './pages/registrar_personal_page.jsx';


function App() {

  return (
    <>
    <HealthCheck />
    <RegistrarPersonalPage />
    </>
  )
}

export default App
