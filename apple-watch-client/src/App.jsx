import React from "react";
import { BrowserRouter as Router, Routes, Route, Navigate } from "react-router-dom";
import Login from "./pages/login/login";
import ActivityChart from "./components/ActivityChart";

function App() {
 
  return (
    <Router>
      <Routes>
        <Route path="/" element={<Login />} />
        <Route path="/activity-chart" element={ <ActivityChart />} />
      </Routes>
    </Router>
  );
}

export default App;
