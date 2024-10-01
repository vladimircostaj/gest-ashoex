import { useState } from 'react'
import HealthCheck from './components/health/health.jsx'
import './App.css'
import { BrowserRouter as Router, Routes, Route } from 'react-router-dom';

import ActualizarPersonalPage from './pages/ActualizarPersonalPage.jsx';

function App() {

  return (
    <>
    <Router>
      <Routes>
        <Route path='/' element={<HealthCheck/>} />
        <Route path='/modificar-personal' element={<ActualizarPersonalPage />} />
      </Routes>
    </Router>
    </>
 )
}

export default App

