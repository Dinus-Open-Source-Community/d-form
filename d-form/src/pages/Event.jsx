import React from "react";
import EventList from "../components/EventList";
import { useNavigate } from "react-router-dom";

const Events = () => {
  const navigate = useNavigate();

  const handleEventClick = (eventId) => {
    navigate(`/events/${eventId}`);
  };

  return (
    <div>
      <EventList showToday={true} onEventClick={handleEventClick} />
    </div>
  );
};

export default Events;
