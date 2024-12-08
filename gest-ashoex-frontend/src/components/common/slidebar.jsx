import React, { useState } from "react";
import styled from "styled-components";
import { IconButton, Divider } from "@mui/material";
import CloseIcon from "@mui/icons-material/Close";
import CalendarTodayIcon from "@mui/icons-material/CalendarToday";
import BookIcon from "@mui/icons-material/Book";
import PersonIcon from "@mui/icons-material/Person";
import AddCircleIcon from "@mui/icons-material/AddCircle";
import ListAltIcon from "@mui/icons-material/ListAlt";
import ApartmentIcon from '@mui/icons-material/Apartment';
import ExpandMoreIcon from "@mui/icons-material/ExpandMore";
import ExpandLessIcon from "@mui/icons-material/ExpandLess";
import ScannerIcon from '@mui/icons-material/Scanner';
import { useNavigate } from "react-router-dom"; // Import useNavigate

const SliderBar = ({ isOpen, toggleSlider }) => {
  if (!isOpen) return null;

  const [isAmbientesOpen, setIsAmbientesOpen] = useState(false);
  const [isCurriculaOpen, setIsCurriculaOpen] = useState(false);
  const [isPersonalOpen, setIsPersonalOpen] = useState(false);

  const navigate = useNavigate(); // Initialize the navigate function

  const toggleAmbientes = () => setIsAmbientesOpen((prev) => !prev);
  const toggleCurricula = () => setIsCurriculaOpen((prev) => !prev);
  const togglePersonal = () => setIsPersonalOpen((prev) => !prev);

  return (
    <SliderContainer>
      <SliderHeader>
        <Title>Gest - Ashoex</Title>
        <IconButton onClick={toggleSlider}>
          <CloseIcon style={{ color: "white" }} />
        </IconButton>
      </SliderHeader>

      <Divider style={{ backgroundColor: "gray" }} />

      <Menu>
        {/* Ambientes Section */}
        <MenuItem onClick={toggleAmbientes}>
          <CalendarTodayIcon style={{ color: "white", marginRight: "10px" }} />
          Ambientes{" "}
          {isAmbientesOpen ? (
            <ExpandLessIcon style={{ color: "white" }} />
          ) : (
            <ExpandMoreIcon style={{ color: "white" }} />
          )}
        </MenuItem>
        {isAmbientesOpen && (
          <SubMenu>
            <SubMenuItem onClick={() => navigate("/registrar-ambiente")}>
              <AddCircleIcon style={{ color: "white", marginRight: "10px" }} />
              Agregar Ambiente
            </SubMenuItem>
            <SubMenuItem onClick={() => navigate("/lista-ambientes")}>
              <ListAltIcon style={{ color: "white", marginRight: "10px" }} />
              Ver Lista de Ambientes
            </SubMenuItem>
            <SubMenuItem onClick={() => navigate("/editar-edificio")}>
              <ApartmentIcon style={{ color: "white", marginRight: "10px" }} />
              Editar Edificio
            </SubMenuItem>
            <SubMenuItem onClick={() => navigate("/lista-usos")}>
              <ListAltIcon style={{ color: "white", marginRight: "10px" }} />
              Ver Lista de Usos
            </SubMenuItem>

            <SubMenuItem onClick={() => navigate("/registrar-facilidad")}>
              <ScannerIcon style={{ color: "white", marginRight: "10px" }} />
              Registrar Facilidad
            </SubMenuItem>
          </SubMenu>
        )}

        {/* Curricula Section */}
        <MenuItem onClick={toggleCurricula}>
          <BookIcon style={{ color: "white", marginRight: "10px" }} />
          Currícula{" "}
          {isCurriculaOpen ? (
            <ExpandLessIcon style={{ color: "white" }} />
          ) : (
            <ExpandMoreIcon style={{ color: "white" }} />
          )}
        </MenuItem>
        {isCurriculaOpen && (
          <SubMenu>
            <SubMenuItem onClick={() => navigate("/registrar-curricula")} >
              <AddCircleIcon style={{ color: "white", marginRight: "10px" }} />
              Agregar Currícula
            </SubMenuItem>
            <SubMenuItem onClick={() => navigate("/registrar-materia")}>
              <AddCircleIcon style={{ color: "white", marginRight: "10px" }} />
              Agregar materia
            </SubMenuItem>
            <SubMenuItem onClick={() => navigate("/registrar-carrera")}>
              <AddCircleIcon style={{ color: "white", marginRight: "10px" }} />
              Agregar carrera
            </SubMenuItem>
            <SubMenuItem onClick={() => navigate("/listar-curriculas")}>
              <ListAltIcon style={{ color: "white", marginRight: "10px" }} />
              Ver Lista de Currículas
            </SubMenuItem>
          </SubMenu>
        )}

        {/* Personal Section */}
        <MenuItem onClick={togglePersonal}>
          <PersonIcon style={{ color: "white", marginRight: "10px" }} />
          Personal{" "}
          {isPersonalOpen ? (
            <ExpandLessIcon style={{ color: "white" }} />
          ) : (
            <ExpandMoreIcon style={{ color: "white" }} />
          )}
        </MenuItem>
        {isPersonalOpen && (
          <SubMenu>
            <SubMenuItem onClick={() => navigate("/registrar-personal")}>
              <AddCircleIcon style={{ color: "white", marginRight: "10px" }} />
              Agregar Personal
            </SubMenuItem>
            <SubMenuItem onClick={() => navigate("/ListaPersonalAcademico")}>
              <ListAltIcon style={{ color: "white", marginRight: "10px" }} />
              Ver Lista de Personal
            </SubMenuItem>
          </SubMenu>
        )}
      </Menu>
    </SliderContainer>
  );
};

const SliderContainer = styled.div`
  width: 280px;
  height: 100%;
  background-color: #2d2a2a;
  color: white;
  position: fixed;
  top: 0;
  left: 0;
  z-index: 1200;
  padding: 20px;
  overflow-y: auto;
  box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.5);
`;

const SliderHeader = styled.div`
  display: flex;
  justify-content: space-between;
  align-items: center;
  padding: 10px;
  width: 100%;
`;

const Title = styled.h1`
  font-size: 1.8 rem;
  color: white;
  text-align: center;
  margin: 0;
  flex-grow: 1;
`;

const Menu = styled.div`
  margin-top: 20px;
`;

const MenuItem = styled.div`
  font-size: 1.1rem;
  cursor: pointer;
  display: flex;
  align-items: center;
  padding: 10px 0;
  margin-bottom: 10px;

  &:hover {
    background-color: rgba(255, 255, 255, 0.1);
    border-radius: 4px;
  }
`;

const SubMenu = styled.div`
  padding-left: 20px;
  margin-top: 10px;
`;

const SubMenuItem = styled.div`
  font-size: 1rem;
  cursor: pointer;
  display: flex;
  align-items: center;
  padding: 5px 0;
  margin-bottom: 8px;

  &:hover {
    background-color: rgba(255, 255, 255, 0.1);
    border-radius: 4px;
  }
`;

export default SliderBar;
