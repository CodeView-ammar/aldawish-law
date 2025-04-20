import React, {useEffect, useState} from 'react';
import axios from "axios";
import Call from "./Components/Call.jsx";
import AC from "agora-chat";
import Chat from "./Components/Chat.jsx";

const App = () => {
    const [orderDetails, setOrderDetails] = useState([]);
    const conn = new AC.connection({
        appKey: "411204763#1393633",
    });

    useEffect(() => {
        const id = window.order_id;
        const url = `/api/profile/orders/${id}/session/join`;
        axios.post(url, {}, {
            headers: {
                'Content-Type': 'application/json',
                'Accept': 'application/json',
                'Authorization': `Bearer ${window.token}`
            }
        }).then((data) => {
            setOrderDetails(data.data.data);
        })
    }, []);


    useEffect(() => {
        conn.open({
            user: orderDetails.partner?.id,
            agoraToken: orderDetails.partner?.token,
        });
    }, [orderDetails])
    return <>
        <Call token={orderDetails.agora_token}
              channel={orderDetails.channel}
              partner={orderDetails.partner}
        />

    </>
};

export default App;
