/**
 * SMARTBUS API
 * No description provided (generated by Swagger Codegen https://github.com/swagger-api/swagger-codegen)
 *
 * OpenAPI spec version: 1.0.0
 * 
 *
 * NOTE: This class is auto generated by the swagger code generator program.
 * https://github.com/swagger-api/swagger-codegen.git
 * Do not edit the class manually.
 */


#include "ModelVehicle.h"

#include "SWGHelpers.h"

#include <QJsonDocument>
#include <QJsonArray>
#include <QObject>
#include <QDebug>

namespace api {

ModelVehicle::ModelVehicle(QString* json) {
    init();
    this->fromJson(*json);
}

ModelVehicle::ModelVehicle() {
    init();
}

ModelVehicle::~ModelVehicle() {
    this->cleanup();
}

void
ModelVehicle::init() {
    id = 0L;
    rfidcard = new ModelRfidCard();
    comany_id = 0L;
    route_id = 0L;
    device_id = 0L;
    route = new ModelRoute();
    is_running = 0;
    license_plates = new QString("");
    rfid = new QString("");
    lat = 0.0f;
    lng = 0.0f;
    created_at = NULL;
    updated_at = NULL;
}

void
ModelVehicle::cleanup() {

    if(rfidcard != nullptr) {
        delete rfidcard;
    }



    if(route != nullptr) {
        delete route;
    }

    if(license_plates != nullptr) {
        delete license_plates;
    }
    if(rfid != nullptr) {
        delete rfid;
    }


    if(created_at != nullptr) {
        delete created_at;
    }
    if(updated_at != nullptr) {
        delete updated_at;
    }
}

ModelVehicle*
ModelVehicle::fromJson(QString &json) {
    QByteArray array (json.toStdString().c_str());
    QJsonDocument doc = QJsonDocument::fromJson(array);
    QJsonObject jsonObject = doc.object();
    this->fromJsonObject(jsonObject);
    return this;
}

void
ModelVehicle::fromJsonObject(QJsonObject &pJson) {
    ::api::setValue(&id, pJson["id"], "qint64", "");
    ::api::setValue(&rfidcard, pJson["rfidcard"], "ModelRfidCard", "ModelRfidCard");
    ::api::setValue(&comany_id, pJson["comany_id"], "qint64", "");
    ::api::setValue(&route_id, pJson["route_id"], "qint64", "");
    ::api::setValue(&device_id, pJson["device_id"], "qint64", "");
    ::api::setValue(&route, pJson["route"], "ModelRoute", "ModelRoute");
    ::api::setValue(&is_running, pJson["is_running"], "qint32", "");
    ::api::setValue(&license_plates, pJson["license_plates"], "QString", "QString");
    ::api::setValue(&rfid, pJson["rfid"], "QString", "QString");
    ::api::setValue(&lat, pJson["lat"], "float", "");
    ::api::setValue(&lng, pJson["lng"], "float", "");
    ::api::setValue(&created_at, pJson["created_at"], "QDateTime", "QDateTime");
    ::api::setValue(&updated_at, pJson["updated_at"], "QDateTime", "QDateTime");
}

QString
ModelVehicle::asJson ()
{
    QJsonObject* obj = this->asJsonObject();
    
    QJsonDocument doc(*obj);
    QByteArray bytes = doc.toJson();
    return QString(bytes);
}

QJsonObject*
ModelVehicle::asJsonObject() {
    QJsonObject* obj = new QJsonObject();
    obj->insert("id", QJsonValue(id));
    toJsonValue(QString("rfidcard"), rfidcard, obj, QString("ModelRfidCard"));
    obj->insert("comany_id", QJsonValue(comany_id));
    obj->insert("route_id", QJsonValue(route_id));
    obj->insert("device_id", QJsonValue(device_id));
    toJsonValue(QString("route"), route, obj, QString("ModelRoute"));
    obj->insert("is_running", QJsonValue(is_running));
    toJsonValue(QString("license_plates"), license_plates, obj, QString("QString"));
    toJsonValue(QString("rfid"), rfid, obj, QString("QString"));
    obj->insert("lat", QJsonValue(lat));
    obj->insert("lng", QJsonValue(lng));
    toJsonValue(QString("created_at"), created_at, obj, QString("QDateTime"));
    toJsonValue(QString("updated_at"), updated_at, obj, QString("QDateTime"));

    return obj;
}

qint64
ModelVehicle::getId() {
    return id;
}
void
ModelVehicle::setId(qint64 id) {
    this->id = id;
}

ModelRfidCard*
ModelVehicle::getRfidcard() {
    return rfidcard;
}
void
ModelVehicle::setRfidcard(ModelRfidCard* rfidcard) {
    this->rfidcard = rfidcard;
}

qint64
ModelVehicle::getComanyId() {
    return comany_id;
}
void
ModelVehicle::setComanyId(qint64 comany_id) {
    this->comany_id = comany_id;
}

qint64
ModelVehicle::getRouteId() {
    return route_id;
}
void
ModelVehicle::setRouteId(qint64 route_id) {
    this->route_id = route_id;
}

qint64
ModelVehicle::getDeviceId() {
    return device_id;
}
void
ModelVehicle::setDeviceId(qint64 device_id) {
    this->device_id = device_id;
}

ModelRoute*
ModelVehicle::getRoute() {
    return route;
}
void
ModelVehicle::setRoute(ModelRoute* route) {
    this->route = route;
}

qint32
ModelVehicle::getIsRunning() {
    return is_running;
}
void
ModelVehicle::setIsRunning(qint32 is_running) {
    this->is_running = is_running;
}

QString*
ModelVehicle::getLicensePlates() {
    return license_plates;
}
void
ModelVehicle::setLicensePlates(QString* license_plates) {
    this->license_plates = license_plates;
}

QString*
ModelVehicle::getRfid() {
    return rfid;
}
void
ModelVehicle::setRfid(QString* rfid) {
    this->rfid = rfid;
}

float
ModelVehicle::getLat() {
    return lat;
}
void
ModelVehicle::setLat(float lat) {
    this->lat = lat;
}

float
ModelVehicle::getLng() {
    return lng;
}
void
ModelVehicle::setLng(float lng) {
    this->lng = lng;
}

QDateTime*
ModelVehicle::getCreatedAt() {
    return created_at;
}
void
ModelVehicle::setCreatedAt(QDateTime* created_at) {
    this->created_at = created_at;
}

QDateTime*
ModelVehicle::getUpdatedAt() {
    return updated_at;
}
void
ModelVehicle::setUpdatedAt(QDateTime* updated_at) {
    this->updated_at = updated_at;
}


}

