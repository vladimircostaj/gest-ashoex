import { useState } from "react";
import HealthCheck from "./components/health/health.jsx";
import "./App.css";
import Header from "./components/common/header.jsx";
import SlideBar from "./components/common/slidebar.jsx";

import { BrowserRouter as Router, Routes, Route } from "react-router-dom";
import RegistrarAmbiente from "./pages/Ambiente/registrar_ambiente_page.jsx";
import RegistrarUbicacionForm from './pages/Ambiente/registrar_ubicacion_page.jsx';
import ListaAmbientes from "./pages/Ambiente/listar_ambientes_page.jsx";
import RegistrarPersonal from "./pages/Personal/registrar_personal.jsx";
import EditarAmbiente from "./pages/Ambiente/editar_ambiente_page.jsx";
import RegistrarMateriaForm from "./pages/Curricula/registrar_materia_page.jsx";
import AgregarCarreraPage from "./pages/Curricula/agregar_carrera_page.jsx";
import AgregarCurriculaPage from "./pages/Curricula/agregar_curricula.jsx";
import ListaCurriculas from "./pages/Curricula/listarCurricula.jsx";
import EditarEdificioPage from "./pages/Ambiente/editar_edificio_page.jsx"
import ListaEdificios from "./pages/Ambiente/listar_edificios_page.jsx";
import RegistrarEdificioForm from "./pages/Ambiente/registrar_edificio_page.jsx";
import ListarUsos from "./pages/Ambiente/listar_usos_page.jsx";
import ListarAulas from "./pages/Ambiente/listar_aula_page.jsx";

function App() {
  const [isSliderOpen, setIsSliderOpen] = useState(false);
  const toggleSlider = () => setIsSliderOpen((prevState) => !prevState);
  return (
    <Router>
      <Header toggleSlider={toggleSlider} />
      {isSliderOpen && (
        <SlideBar isOpen={isSliderOpen} toggleSlider={toggleSlider} />
      )}

      <Routes>
        <Route path="/" element={<HealthCheck />}>
          <Route path="/registrar-ambiente" element={<RegistrarAmbiente />} />
          <Route path="/lista-ambientes" element={<ListaAmbientes />} />
          <Route path="/lista-usos" element={<  ListarUsos/>} />
          <Route path="/lista-edificios" element={<ListaEdificios/>} />
          <Route path="/registrar-personal" element={<RegistrarPersonal />} />
          <Route path="/registrar-ubicacion" element={<RegistrarUbicacionForm />} />
          <Route path="/registrar-edificio" element={<RegistrarEdificioForm />} />
          <Route path="/lista-aulas" element={<ListarAulas />} />

          <Route
            path="/editar-ambiente/:ambienteId"
            element={<EditarAmbiente />}
          />
          <Route path="/editar-edificio/:edificioId" element={<EditarEdificioPage />} />
        </Route>
        <Route path="/registrar-materia" element={<RegistrarMateriaForm />} />
        <Route path="/registrar-carrera" element={<AgregarCarreraPage />} />
        <Route path="/registrar-curricula" element={<AgregarCurriculaPage />} />
        <Route path="/listar-curriculas" element={<ListaCurriculas />} />
        

      </Routes> 
    </Router>
  );
}

export default App;
