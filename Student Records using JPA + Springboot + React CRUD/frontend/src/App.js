import logo from './logo.svg';
import './App.css';
import { BrowserRouter, Route, Routes } from 'react-router-dom';
import Home from './components/Home';
import SaveData from './components/SaveData';
import GetData from './components/GetData';
import UpdateData from './components/UpdateData';
import DeleteData from './components/DeleteData';
function App() {
  return (
    <>
    <BrowserRouter>
 
    <Routes>
         <Route path="/" element={<></>}></Route>
         <Route path="/home" element={<Home/>}></Route>
         <Route path="/save-data" element={<SaveData/>}></Route>
         <Route path="/get-data" element={<GetData/>}></Route>
         <Route path="/update-data" element={<UpdateData/>}></Route>
         <Route path="/delete-data" element={<DeleteData/>}></Route>
    </Routes>
    </BrowserRouter>
    </>
  );
}

export default App;
