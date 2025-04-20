import React from 'react';
import { useNavigate } from 'react-router-dom';
import EventList from '../components/EventList';
import BlurText from '../components/BlurText';
import Magnet from '../components/Magnet';

const Home = () => {
  const navigate = useNavigate();

  const handleEventClick = (eventId) => {
    navigate(`/events/${eventId}`);
  };

  return (
    <>
      <div className="mt-16 sm:mt-22 bg-[#343434] text-white text-center py-16 sm:py-24 md:py-32 lg:py-40 px-4">
        <div className="flex flex-col items-center justify-center text-center mb-6 sm:mb-8 space-y-4">
          <div className="flex flex-wrap justify-center items-center gap-2 sm:gap-3 text-3xl sm:text-5xl md:text-6xl lg:text-7xl tracking-widest uppercase">
            <BlurText
              text="WELCOME TO"
              animateBy="words"
              direction="top"
              className="font-extrabold"
            />
            <BlurText
              text="D"
              animateBy="letters"
              className="text-5xl sm:text-8xl md:text-9xl lg:text-[100px] font-extrabold"
            />
            <BlurText
              text="FORM"
              animateBy="letters"
              className="font-normal"
            />
          </div>
        </div>

        {/* Apply Magnet effect to the button */}
        <Magnet
          padding={100}
          magnetStrength={2}
          activeTransition="transform 0.3s ease-out"
          inactiveTransition="transform 0.5s ease-in-out"
          wrapperClassName="inline-block"
          innerClassName="bg-white text-gray-800 font-semibold py-2 px-6 sm:px-8 md:px-10 rounded-lg hover:bg-gray-200 transition-colors cursor-pointer"
          onClick={() => navigate('/events')}
        >
          See All Events
        </Magnet>
      </div>

      <EventList showToday={true} onEventClick={handleEventClick} />
    </>
  );
};

export default Home;
