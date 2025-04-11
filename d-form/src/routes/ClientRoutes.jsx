// File: src/routes/ClientRoutes.jsx
import { Routes, Route, Navigate } from "react-router-dom";

// Import komponen Client
import Home from "../client/pages/Home";
import Event from "../client/pages/Event";
import About from "../client/pages/About";
import EventDetail from "../client/components/EventDetail";

const ClientRoutes = () => {
  return (
    <Routes>
      <Route path="/" element={<Home />} />
      <Route path="/events" element={<Event />} />
      <Route path="/events/:eventId" element={<EventDetail />} />
      <Route path="/about" element={<About />} />
      {/* Redirect lainnya untuk client */}
      <Route path="*" element={<Navigate to="/" />} />
    </Routes>
  );
};

export default ClientRoutes;