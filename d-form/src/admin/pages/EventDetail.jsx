import { Calendar, Clock, MapPin, Users, Copy as CopyIcon } from "lucide-react";
import { useEffect, useState } from "react";
import { useParams } from "react-router-dom";
import {format, addDays} from "date-fns"
import { formatRangedDate } from "../../utils/DateHelper";

const fetchEvent = async (eventID, setData, setError, setCode)=>{
  const baseURL = import.meta.env.VITE_API_URL;
  const apiURL = `${baseURL}/events/${eventID}`;

  const res = await fetch(apiURL, {
                mode: 'cors',
                method: 'GET', 
                headers: {'Content-Type': 'application/json'}
              });
  let data;
  switch(res.status)
  {
    case(200) :
      data = await res.json();
      console.log(data.data);
      setError(false);
      setData(data.data);
      break;
    case 404 :
      setError(true);
      setData({});
      break;
  }
}

const PopupNotification=({ message, type = "success", show, onClose })=>{
  useEffect(() => {
    if (show) {
      const timer = setTimeout(() => onClose(), 2000);
      return () => clearTimeout(timer);
    }
  }, [show, onClose]);

  if (!show) return null;

  return (
    <div className={`fixed top-5 left-1/2 -translate-x-1/2 px-4 py-3 rounded-lg shadow-lg text-white z-50 transition-all duration-300
      ${type === "success" ? "bg-green-600" : "bg-red-600"}`}>
      {message}
    </div>
  );
}
const EventDetail = () => {
  const [data, setData] = useState({});
  const [eventDate, setEventDate] = useState({});
  const [error, setError] = useState(false);
  const {id} = useParams();
  const [popup, setPopup] = useState({ show: false, message: "", type: "success" });
  const handleCopyLink = async (link) => {
    try {
      await navigator.clipboard.writeText(link);
      setPopup({ show: true, message: "Link copied to clipboard!", type: "success" });
    } catch {
      setPopup({ show: true, message: "Failed to copy link.", type: "error" });
    }
  };

  useEffect(()=>{fetchEvent(id, setData, setError)}, [id]);
  useEffect(()=>{
    if(Object.keys(data)?.length)
    {
      const formatted = formatRangedDate(data.start_date, addDays(data.start_date, data.duration_days))
      setEventDate(formatted);
      
    }
  }, [data])
  
  return (
    <>
      <PopupNotification
        {...popup}
        onClose={() => setPopup(p => ({ ...p, show: false }))}
      />
      {(data && Object.keys(data).length > 0) && (
        
        <div className="p-8 pt-28 ml-60">
          <div className="grid grid-cols-1 md:grid-cols-4 gap-2">
            <div className="col-span-3">
              <h1 className="text-3xl text-[#343434] font-bold mb-5">
                {data.name}
              </h1>
              {/* Event Info Cards */}
              <div className="flex flex-col md:flex-row space-y-4 md:space-y-0 md:space-x-8 text-[#343434]">
                <div className="flex items-center gap-2">
                  <Calendar className="w-5 h-5" />
                  <span>
                    
                    <span className="font-semibold">{eventDate.days}</span> <br /> {eventDate.months}
                  </span>
                </div>
    
                <div className="flex items-center gap-2 font-semibold">
                  <Clock className="w-5 h-5" />
                  <span>{format(new Date(new Date().toLocaleDateString()+" "+data.start_time), "kk:mm")} - {format(new Date(new Date().toLocaleDateString()+" "+data.end_time), "kk:mm")}</span>
                </div>
    
                <div className="flex items-center gap-2 font-semibold">
                  <MapPin className="w-5 h-5" />
                  <span>{data.address}</span>
                </div>
    
                <div className="flex items-center gap-2">
                  <Users className="w-5 h-5" />
                  <span>
                    <span className="font-semibold">{data.participants}</span> Participants
                  </span>
                </div>
              </div>
    
              {/* Event Description */}
              <div className="flex flex-col space-y-4 text-[#000000] mt-6">
                {data.description}
                <button className="flex font-bold text-[#343434]">Read more</button>
              </div>
            </div>
    
            {/* Right Column - Buttom Coloms */}
            <div className="col-span-1 space-y-4">
              {/* Contact Information */}
              <div className="flex justify-center">
                <button className="w-48 bg-white border-2 border-black text-black py-2 rounded-xl font-medium hover:bg-gray-200">
                  Edit
                </button>
              </div>
              <div className="flex justify-center">
                <button className="w-48 bg-white border-2 border-black text-black py-2 rounded-xl font-medium hover:bg-gray-200">
                  Scan QR
                </button>
              </div>
              <div className="flex justify-center">
                <button className="w-48 bg-white border-2 border-black text-black py-2 rounded-xl font-medium hover:bg-gray-200" onClick={()=>handleCopyLink(data.gform_url)}>
                  Registration URL
                  <span>
                    <CopyIcon className="w-5 h-5 inline-block ml-2" />
                  </span>
                </button>
              </div>
            </div>
          </div>
          <div className="text-center pt-48 pb-4">
            <span className="font-bold text-gray-500">
              CSV has not been uploaded!
            </span>
          </div>
          <div className="items-center flex justify-center">
            <button
              type="submit"
              className="w-48 bg-[#343434] text-white py-3 rounded-lg hover:bg-[#2a2a2a] transition-colors font-meidum cursor-pointer"
            >
              Upload CSV
            </button>
          </div>
        </div>
        
      )}
    </>
  );
};

export default EventDetail;
