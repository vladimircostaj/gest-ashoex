import { useState } from 'react'
import HealthCheck from './components/health/health.jsx'
import './App.css'
import { BrowserRouter as Router, Routes, Route } from 'react-router-dom';
import './pages/personal/InformacionPersonalAcademicoPage.jsx'
import InformacionPersonalAcademico from './pages/personal/InformacionPersonalAcademicoPage';
import RegistrarPersonalPage from './pages/registrar_personal_page.jsx';


function App() {

  return (
    <>
    <Router>
      <Routes>
        <Route path='/' element={<HealthCheck/>} />
        <Route path='/Informacion' element={<InformacionPersonalAcademico/>} />
        <Route path='/registrar-personal' element={<RegistrarPersonalPage/>} />
      </Routes>
    </Router>
    
    </>
  )
}

export default App
