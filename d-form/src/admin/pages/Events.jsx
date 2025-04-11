import React from 'react';
import EventList from '../components/dashboard/EventList';
import { useNavigate } from 'react-router-dom';

const Events = () => {
  const navigate = useNavigate();

  const handleEventClick = (id) => {
    navigate(`/admin/events/${id}`);
  };

  return (
    <div className="p-8 pt-28 ml-60">
      <EventList showToday={false} showUpcoming={true} showOngoing = {true} onEventClick={handleEventClick} />
    </div>
  );
};

export default Events;