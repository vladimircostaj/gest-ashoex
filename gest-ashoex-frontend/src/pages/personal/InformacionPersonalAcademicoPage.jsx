import React from 'react';

const InformacionPersonalAcademico = () => {

    const [usuario, setUsuario] = useState([]);

    useEffect(() => {
        getUsuario();
    }, []);

    const getUsuario = async () =>{
        
        //const respuesta = await axios.get(`http://127.0.0.1:8000/api/get_usuario/${usuario.id}`) 
        //setUsuario(respuesta.data.destino)
    }

    const user = {
      name: 'Leonel Gongora',
      email: 'strokehead@outlook.es',
      telefono: '69482773',
      estado: 'estado',
      tipo_personal: 'docente',
      avatar: 'https://via.placeholder.com/150'

    };

    return (
      <section style={{ 
        display: 'flex', 
        justifyContent: 'center', 
        alignItems: 'center', 
        height: '100vh', 
        backgroundColor: '#f5f5f5' 
      }}>
        <div style={{ 
          backgroundColor: '#fff', 
          padding: '40px', 
          borderRadius: '10px', 
          boxShadow: '0 4px 8px rgba(0, 0, 0, 0.1)', 
          maxWidth: '800px', 
          width: '100%', 
          textAlign: 'center' 
        }}>
          <img
            src={user.avatar}
            alt={`${user.name}'s avatar`}
            style={{ 
              width: '150px', 
              height: '150px', 
              borderRadius: '50%', 
              marginBottom: '20px' 
            }}
          />


          <div style={{ marginTop: '20px' }}>
          <p style={{ margin: '5px 0', color: '#666', fontSize: '18px' }}><strong>Nombre:</strong> {user.name}</p>
          </div>

          <div style={{ marginTop: '20px' }}>
          <p style={{ margin: '5px 0', color: '#666', fontSize: '18px' }}><strong>Correo:</strong> {user.email}</p>
          </div>

          <div style={{ marginTop: '20px' }}>
          <p style={{ margin: '5px 0', color: '#666', fontSize: '18px' }}><strong>Telefono:</strong> {user.telefono}</p>
          </div>

          <div style={{ marginTop: '20px' }}>
          <p style={{ margin: '5px 0', color: '#666', fontSize: '18px' }}><strong>Estado:</strong> {user.estado}</p>
          </div>

          <div style={{ marginTop: '20px' }}>
          <p style={{ margin: '5px 0', color: '#666', fontSize: '18px' }}><strong>Tipo de Personal: </strong>{user.tipo_personal}</p>
          </div>
        </div>
      </section>
    );
  };
  
  export default InformacionPersonalAcademico;