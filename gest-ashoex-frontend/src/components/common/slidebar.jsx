import React, { useState } from 'react';
import styled from 'styled-components';
import { IconButton, Divider } from '@mui/material';
import CloseIcon from '@mui/icons-material/Close';

const SliderBar = ({ isOpen, toggleSlider }) => {
  if (!isOpen) return null;

  const [isAmbientesOpen, setIsAmbientesOpen] = useState(false);
  const [isCurriculaOpen, setIsCurriculaOpen] = useState(false);
  const [isPersonalOpen, setIsPersonalOpen] = useState(false);

  const toggleAmbientes = () => setIsAmbientesOpen((prev) => !prev);
  const toggleCurricula = () => setIsCurriculaOpen((prev) => !prev);
  const togglePersonal = () => setIsPersonalOpen((prev) => !prev);

  return (
    <SliderContainer>
      <SliderHeader>
        <Title>Gest - Ashoex</Title>
        <IconButton onClick={toggleSlider}>
          <CloseIcon style={{ color: 'white' }} />
        </IconButton>
      </SliderHeader>

      <Divider style={{ backgroundColor: 'gray' }} />

      
      <Menu>
        <MenuItem onClick={toggleAmbientes}>
          📅 Ambientes {isAmbientesOpen ? '▲' : '▼'}
        </MenuItem>
        {isAmbientesOpen && (
          <SubMenu>
            <SubMenuItem>➕ Agregar Ambiente</SubMenuItem>
            <SubMenuItem>📜 Ver Lista de Ambientes</SubMenuItem>
          </SubMenu>
        )}

        <MenuItem onClick={toggleCurricula}>
          📘 Currícula {isCurriculaOpen ? '▲' : '▼'}
        </MenuItem>
        {isCurriculaOpen && (
          <SubMenu>
            <SubMenuItem>➕ Agregar Currícula</SubMenuItem>
            <SubMenuItem>📜 Ver Lista de Currículas</SubMenuItem>
          </SubMenu>
        )}

        <MenuItem onClick={togglePersonal}>
          🧑‍💼 Personal {isPersonalOpen ? '▲' : '▼'}
        </MenuItem>
        {isPersonalOpen && (
          <SubMenu>
            <SubMenuItem>➕ Agregar Personal</SubMenuItem>
            <SubMenuItem>📜 Ver Lista de Personal</SubMenuItem>
          </SubMenu>
        )}
      </Menu>
    </SliderContainer>
  );
};

const SliderContainer = styled.div`
  width: 300px;
  height: 100%;
  background-color: black;
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
  padding-bottom: 10px;
`;

const Title = styled.h1`
  font-size: 1.2rem;
  color: white;
`;

const Menu = styled.div`
  margin-top: 20px;
`;

const MenuItem = styled.div`
  margin-bottom: 20px;
  font-size: 1.2rem;
  cursor: pointer;
  display: flex;
  justify-content: space-between;
  align-items: center;

  &:hover {
    text-decoration: underline;
  }
`;

const SubMenu = styled.div`
  padding-left: 20px;
  margin-top: 10px;
`;

const SubMenuItem = styled.div`
  margin-bottom: 10px;
  font-size: 1rem;
  cursor: pointer;

  &:hover {
    text-decoration: underline;
  }
`;

export default SliderBar;
