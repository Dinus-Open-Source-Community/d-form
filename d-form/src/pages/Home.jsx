import React from 'react';
import EventList from '../components/EventList';
import { useNavigate } from 'react-router-dom';

const Home = () => {
  const navigate = useNavigate();

  const handleEventClick = (eventId) => {
    navigate(`/events/${eventId}`);
  };

  return (
    <>
      <div className="mt-16 sm:mt-22 bg-[#343434] text-white text-center py-16 sm:py-24 md:py-32 lg:py-40 px-4">
        <div className="flex flex-col items-center justify-center text-center mb-6 sm:mb-8">
          <div className="flex flex-wrap justify-center items-center text-3xl sm:text-5xl md:text-6xl lg:text-7xl font-extrabold tracking-widest uppercase gap-2 sm:gap-4 md:gap-5">
            <span>WELCOME TO</span>
            <span className="text-6xl sm:text-8xl md:text-9xl lg:text-[100px] font-extrabold leading-none">
              D
            </span>
            <span className="font-normal">FORM</span>
          </div>
        </div>

        <button
          className="bg-white text-gray-800 font-semibold py-2 px-6 sm:px-8 md:px-10 rounded-lg hover:bg-gray-200 transition-colors cursor-pointer"
          onClick={() => navigate('/events')}
        >
          See All Events
        </button>
      </div>

      {/* Menampilkan hanya upcoming events */}
      <EventList showToday={false} onEventClick={handleEventClick} />
    </>
  );
};

export default Home;
