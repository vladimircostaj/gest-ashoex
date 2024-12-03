import { useEffect, useState } from "react";
import Title from "../../components/typography/title";
import materiaService from "../../services/materiaService";

const ListarMaterias = () => {
    
    const [materias, setMaterias] = useState([]);
    
    useEffect(() => {
      async function fetchMaterias() {
        const data = await materiaService.fetchMaterias();
        setMaterias(data.data);
        console.log(data.data);
      }
    
      fetchMaterias();
    
    }, []);
    


    return (
      
      <div className="container mt-5">
        <div className="table title">
          <div className="row">
            <div className="">
              <Title text={"Listado de Materias"}></Title>
            </div>
          </div>
        </div>
      </div>
  );
};

export default ListarMaterias;