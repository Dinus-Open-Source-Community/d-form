import { Calendar, Clock, MapPin, Users, Copy as CopyIcon } from "lucide-react";

const EventDetail = () => {
  return (
    <div className="p-8 pt-28 ml-60">
      <div className="grid grid-cols-1 md:grid-cols-4 gap-2">
        <div className="col-span-3">
          <h1 className="text-3xl text-[#343434] font-bold mb-5">
            Open Source on The School
          </h1>
          {/* Event Info Cards */}
          <div className="flex flex-col md:flex-row space-y-4 md:space-y-0 md:space-x-8 text-[#343434]">
            <div className="flex items-center gap-2">
              <Calendar className="w-5 h-5" />
              <span>
                <span className="font-semibold">Sunday 21 - Tuesday 24</span>{" "}
                October 2024
              </span>
            </div>

            <div className="flex items-center gap-2 font-semibold">
              <Clock className="w-5 h-5" />
              <span>08:00 - 12.00</span>
            </div>

            <div className="flex items-center gap-2 font-semibold">
              <MapPin className="w-5 h-5" />
              <span>UDINUS H6</span>
            </div>

            <div className="flex items-center gap-2">
              <Users className="w-5 h-5" />
              <span>
                <span className="font-semibold">50</span> Participant
              </span>
            </div>
          </div>

          {/* Event Description */}
          <div className="flex flex-col space-y-4 text-[#000000] mt-6">
            <p>Hallo Doscomers!!!</p>
            <p>
              Tahun ini, OOTS hadir lebih special karena diselenggarakan
              bersamaan FIK FAIR! jangan lewatkan kesempatan seru dan berkesan
              ini di Universitas Dian Nuswantoro. Dapatkan ilmu dan pengalaman
              dari pemateri-pemateri keren yang siap menginspirasi kalian.
              Dijamin, tahun ini lebih seru daripada sebelumnya!!!!
            </p>
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
            <button className="w-48 bg-white border-2 border-black text-black py-2 rounded-xl font-medium hover:bg-gray-200">
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
  );
};

export default EventDetail;
