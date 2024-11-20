import React, { useState } from "react";
import styled from "styled-components";
import { IconButton, Divider } from "@mui/material";
import MenuIcon from "@mui/icons-material/Menu";
import CloseIcon from "@mui/icons-material/Close";
import ExpandLessIcon from "@mui/icons-material/ExpandLess";
import ExpandMoreIcon from "@mui/icons-material/ExpandMore";

const SliderMenu = () => {
  const [isOpen, setIsOpen] = useState(false);
  const [activeMenu, setActiveMenu] = useState(null); 
  const toggleSlider = () => setIsOpen(!isOpen);
  const toggleMenu = (menu) => {
    setActiveMenu(activeMenu === menu ? null : menu);
  };

  return (
    <>

    

      {isOpen && (
        <SliderContainer>
          <SliderHeader>
            <Title>Gest - Ashoex</Title>
            <IconButton onClick={toggleSlider}>
              <CloseIcon style={{ color: "white" }} />
            </IconButton>
          </SliderHeader>

          <Divider style={{ backgroundColor: "gray" }} />

          {/* Menú */}
          <Menu>
            <MenuItem>
              <MenuTitle onClick={() => toggleMenu("ambientes")}>
                📅 Ambientes {activeMenu === "ambientes" ? <ExpandLessIcon /> : <ExpandMoreIcon />}
              </MenuTitle>
              {activeMenu === "ambientes" && (
                <SubMenu>
                  <SubMenuItem>➕ Agregar Ambiente</SubMenuItem>
                  <SubMenuItem>🔍 Visualizar Ambientes</SubMenuItem>
                </SubMenu>
              )}
            </MenuItem>

            <MenuItem>
              <MenuTitle onClick={() => toggleMenu("curricula")}>
                📘 Currícula {activeMenu === "curricula" ? <ExpandLessIcon /> : <ExpandMoreIcon />}
              </MenuTitle>
              {activeMenu === "curricula" && (
                <SubMenu>
                  <SubMenuItem>➕ Agregar Currícula</SubMenuItem>
                  <SubMenuItem>🔍 Visualizar Currículas</SubMenuItem>
                </SubMenu>
              )}
            </MenuItem>

            <MenuItem>
              <MenuTitle onClick={() => toggleMenu("personal")}>
                🧑‍💼 Personal {activeMenu === "personal" ? <ExpandLessIcon /> : <ExpandMoreIcon />}
              </MenuTitle>
              {activeMenu === "personal" && (
                <SubMenu>
                  <SubMenuItem>➕ Agregar Personal</SubMenuItem>
                  <SubMenuItem>🔍 Visualizar Personal</SubMenuItem>
                </SubMenu>
              )}
            </MenuItem>
          </Menu>
        </SliderContainer>
      )}
    </>
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
`;

const MenuTitle = styled.div`
  display: flex;
  justify-content: space-between;
  align-items: center;
  font-size: 1.2rem;
  cursor: pointer;

  &:hover {
    text-decoration: underline;
  }
`;

const SubMenu = styled.div`
  margin-left: 20px;
  margin-top: 10px;
  background-color: #1c1c1c;
  border-radius: 8px;
  padding: 10px;
`;

const SubMenuItem = styled.div`
  font-size: 1rem;
  margin-bottom: 10px;
  cursor: pointer;

  &:hover {
    color: #4e75ff;
  }
`;

export default SliderMenu;
