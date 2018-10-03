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


#include "ModelManagerDevice.h"

#include "SWGHelpers.h"

#include <QJsonDocument>
#include <QJsonArray>
#include <QObject>
#include <QDebug>

namespace api {

ModelManagerDevice::ModelManagerDevice(QString* json) {
    init();
    this->fromJson(*json);
}

ModelManagerDevice::ModelManagerDevice() {
    init();
}

ModelManagerDevice::~ModelManagerDevice() {
    this->cleanup();
}

void
ModelManagerDevice::init() {
    id = 0L;
    device_model = new ModelDevModel();
    identity = new QString("");
    is_running = 0;
    version = 0L;
    lat = 0.0;
    lng = 0.0f;
    created_at = NULL;
    updated_at = NULL;
}

void
ModelManagerDevice::cleanup() {

    if(device_model != nullptr) {
        delete device_model;
    }
    if(identity != nullptr) {
        delete identity;
    }


    if(lat != nullptr) {
        delete lat;
    }

    if(created_at != nullptr) {
        delete created_at;
    }
    if(updated_at != nullptr) {
        delete updated_at;
    }
}

ModelManagerDevice*
ModelManagerDevice::fromJson(QString &json) {
    QByteArray array (json.toStdString().c_str());
    QJsonDocument doc = QJsonDocument::fromJson(array);
    QJsonObject jsonObject = doc.object();
    this->fromJsonObject(jsonObject);
    return this;
}

void
ModelManagerDevice::fromJsonObject(QJsonObject &pJson) {
    ::api::setValue(&id, pJson["id"], "qint64", "");
    ::api::setValue(&device_model, pJson["device_model"], "ModelDevModel", "ModelDevModel");
    ::api::setValue(&identity, pJson["identity"], "QString", "QString");
    ::api::setValue(&is_running, pJson["is_running"], "qint32", "");
    ::api::setValue(&version, pJson["version"], "qint64", "");
    ::api::setValue(&lat, pJson["lat"], "ModelNumber", "ModelNumber");
    ::api::setValue(&lng, pJson["lng"], "float", "");
    ::api::setValue(&created_at, pJson["created_at"], "QDateTime", "QDateTime");
    ::api::setValue(&updated_at, pJson["updated_at"], "QDateTime", "QDateTime");
}

QString
ModelManagerDevice::asJson ()
{
    QJsonObject* obj = this->asJsonObject();
    
    QJsonDocument doc(*obj);
    QByteArray bytes = doc.toJson();
    return QString(bytes);
}

QJsonObject*
ModelManagerDevice::asJsonObject() {
    QJsonObject* obj = new QJsonObject();
    obj->insert("id", QJsonValue(id));
    toJsonValue(QString("device_model"), device_model, obj, QString("ModelDevModel"));
    toJsonValue(QString("identity"), identity, obj, QString("QString"));
    obj->insert("is_running", QJsonValue(is_running));
    obj->insert("version", QJsonValue(version));
    toJsonValue(QString("lat"), lat, obj, QString("ModelNumber"));
    obj->insert("lng", QJsonValue(lng));
    toJsonValue(QString("created_at"), created_at, obj, QString("QDateTime"));
    toJsonValue(QString("updated_at"), updated_at, obj, QString("QDateTime"));

    return obj;
}

qint64
ModelManagerDevice::getId() {
    return id;
}
void
ModelManagerDevice::setId(qint64 id) {
    this->id = id;
}

ModelDevModel*
ModelManagerDevice::getDeviceModel() {
    return device_model;
}
void
ModelManagerDevice::setDeviceModel(ModelDevModel* device_model) {
    this->device_model = device_model;
}

QString*
ModelManagerDevice::getIdentity() {
    return identity;
}
void
ModelManagerDevice::setIdentity(QString* identity) {
    this->identity = identity;
}

qint32
ModelManagerDevice::getIsRunning() {
    return is_running;
}
void
ModelManagerDevice::setIsRunning(qint32 is_running) {
    this->is_running = is_running;
}

qint64
ModelManagerDevice::getVersion() {
    return version;
}
void
ModelManagerDevice::setVersion(qint64 version) {
    this->version = version;
}

ModelNumber*
ModelManagerDevice::getLat() {
    return lat;
}
void
ModelManagerDevice::setLat(ModelNumber* lat) {
    this->lat = lat;
}

float
ModelManagerDevice::getLng() {
    return lng;
}
void
ModelManagerDevice::setLng(float lng) {
    this->lng = lng;
}

QDateTime*
ModelManagerDevice::getCreatedAt() {
    return created_at;
}
void
ModelManagerDevice::setCreatedAt(QDateTime* created_at) {
    this->created_at = created_at;
}

QDateTime*
ModelManagerDevice::getUpdatedAt() {
    return updated_at;
}
void
ModelManagerDevice::setUpdatedAt(QDateTime* updated_at) {
    this->updated_at = updated_at;
}


}

