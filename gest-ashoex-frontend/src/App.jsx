import { useState } from 'react';
import { BrowserRouter as Router, Routes, Route } from 'react-router-dom';
import './App.css';


import HealthCheck from './components/health/health.jsx';
import InformacionPersonalAcademico from './pages/personal/InformacionPersonalAcademicoPage';
import RegistrarPersonalPage from './pages/registrar_personal_page.jsx';
import ListaPersonalAcademico from './components/ListaPersonalAcademico/ListaPersonalAcademico.jsx';
import ActualizarPersonalPage from './pages/ActualizarPersonalPage.jsx';
import Header from './components/common/header.jsx';
import SliderBar from './components/common/slideBar.jsx';

function App() {
  const [isSliderOpen, setIsSliderOpen] = useState(false);
  const toggleSlider = () => setIsSliderOpen((prevState) => !prevState);

  return (
    <Router>
      <Header toggleSlider={toggleSlider} />
      <SliderBar isOpen={isSliderOpen} toggleSlider={toggleSlider} />

      <Routes>
        <Route path="/" element={<HealthCheck />} />
        <Route path="/personal/:id/informacion" element={<InformacionPersonalAcademico />} />
        <Route path="/registrar-personal" element={<RegistrarPersonalPage />} />
        <Route path="/ListaPersonalAcademico" element={<ListaPersonalAcademico />} />
        <Route path="/modificar-personal" element={<ActualizarPersonalPage />} />
      </Routes>
    </Router>
  );
}

export default App;
